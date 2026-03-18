const { Button } = wp.components;
const { PluginDocumentSettingPanel } = wp.editor;
const { useState, useEffect } = wp.element;
const { __ } = wp.i18n;
const apiFetch = wp.apiFetch;

const Sidebar = () => {

    // Do not render anything if the user does not have the required capability.
    if (parseInt(window.DAEXTINMA_PARAMETERS.user_has_interlinks_optimization_mb_required_capability, 10) !== 1) {
        return null;
    }

    // Do not render anything if this editor tool is not enabled in this post type.
    if (parseInt(window.DAEXTINMA_PARAMETERS.interlinks_optimization_is_active_in_post_type, 10) !== 1) {
        return null;
    }

  const [optimizationData, setOptimizationData] = useState(null);

    // Fetch interlinks optimization data when the component mounts and on post save.
    useEffect(() => {
        const postId = parseInt(document.getElementById('post_ID').value, 10);

        const fetchData = () => {
            wp.apiFetch({
                path: '/daext-interlinks-manager/v1/generate-interlinks-optimization',
                method: 'POST',
                data: { id: postId },
            })
                .then((response) => {
                    setOptimizationData(response);
                })
                .catch((error) => {
                    console.error('Error fetching interlinks optimization data:', error);
                });
        };

        // Initial fetch
        fetchData();

        let wasSaving = false;

        const unsubscribe = wp.data.subscribe(() => {
            const isSaving = wp.data.select('core/editor').isSavingPost();
            const isAutosaving = wp.data.select('core/editor').isAutosavingPost();

            // Detect when a manual save completes
            if (wasSaving && !isSaving && !isAutosaving) {
                fetchData(); // Re-fetch optimization data
            }

            wasSaving = isSaving;
        });

        return () => {
            unsubscribe();
        };
    }, []);

  return (
      <PluginDocumentSettingPanel
          name="interlinks-manager"
          title={__('Internal Links Optimization', 'daext-interlinks-manager')}
      >
        <div className="daextinma-container">
            <div className="daextinma-container">
                <div className="daextinma-meta-message">
                    {optimizationData ? (() => {
                        const totalNumberOfInterlinks = optimizationData['total_number_of_interlinks'];
                        const numberOfManualInterlinks = optimizationData['number_of_manual_interlinks'];
                        const suggestedMin = optimizationData['suggested_min_number_of_interlinks'];
                        const suggestedMax = optimizationData['suggested_max_number_of_interlinks'];

                        // Replicate generate_interlinks_optimization_metabox_html() output.

                        const isOptimized =
                            totalNumberOfInterlinks >= suggestedMin &&
                            totalNumberOfInterlinks <= suggestedMax;

                        if (isOptimized) {
                            return (
                                <p>
                                    {__(
                                        'The number of internal links in this post is within the recommended range.',
                                        'daext-interlinks-manager'
                                    )}
                                </p>
                            );
                        }

                        const singularPlural = wp.i18n._n(
                            'internal link',
                            'internal links',
                            totalNumberOfInterlinks,
                            'daext-interlinks-manager'
                        );

                        if (suggestedMin === suggestedMax) {
                            return (
                                <>
                                    <p>
                                        {__(
                                            'This post currently contains',
                                            'daext-interlinks-manager'
                                        )}{' '}
                                        {totalNumberOfInterlinks}{' '}
                                        {singularPlural}.{' '}
                                        {__(
                                            'Based on the content length and your settings, the recommended number is',
                                            'daext-interlinks-manager'
                                        )}{' '}
                                        {suggestedMin}.
                                    </p>
                                </>
                            );
                        }

                        return (
                            <>
                                <p>
                                    {__(
                                        'This post currently contains',
                                        'daext-interlinks-manager'
                                    )}{' '}
                                    {totalNumberOfInterlinks}{' '}
                                    {singularPlural}.{' '}
                                    {__(
                                        'Based on the content length and your settings, the recommended number is between',
                                        'daext-interlinks-manager'
                                    )}{' '}
                                    {suggestedMin}{' '}
                                    {__('and', 'daext-interlinks-manager')}{' '}
                                    {suggestedMax}.
                                </p>
                            </>
                        );
                    })() : (
                        <p></p>
                    )}
                </div>
            </div>

        </div>
      </PluginDocumentSettingPanel>
  );
};

export default Sidebar;
