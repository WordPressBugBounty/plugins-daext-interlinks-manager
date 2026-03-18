const { TextControl } = wp.components;
const { SelectControl } = wp.components;
const { dispatch, select } = wp.data;
const { PluginDocumentSettingPanel } = wp.editor;
const { Component } = wp.element;
const { __ } = wp.i18n;

export default class Sidebar extends Component {
    constructor(props) {
        super(...arguments);

        // The state is used only to rerender the component with setState
        this.state = {
            seoPower: '',
        };
    }

    componentDidMount() {
        const meta = select('core/editor').getEditedPostAttribute('meta');
        let seoPower = meta['_daextinma_seo_power'];

        if (seoPower === '' || seoPower === undefined) {
            seoPower = window.DAEXTINMA_PARAMETERS.default_seo_power;
        }

        this.setState({
            seoPower: seoPower,
        });
    }

    render() {
        // Do not render anything if the user does not have the required capability.
        if (parseInt(window.DAEXTINMA_PARAMETERS.user_has_interlinks_options_mb_required_capability, 10) !== 1) {
            return null;
        }

        // Do not render anything if this editor tool is not enabled in this post type.
        if (parseInt(window.DAEXTINMA_PARAMETERS.interlinks_options_is_active_in_post_type, 10) !== 1) {
            return null;
        }

        return (
            <PluginDocumentSettingPanel
                name="interlinks-manager"
                title={__('Internal Links Settings', 'daext-interlinks-manager')}
            >
                <TextControl
                    label={__('Total Link Equity', 'daext-interlinks-manager')}
                    type={'number'}
                    help={__('Set the amount of link equity this post passes through its internal links. This value determines the link equity assigned to linked pages in the plugin reports.', 'daext-interlinks-manager')}
                    value={this.state.seoPower}
                    onChange={(value) => {
                        dispatch('core/editor').editPost({
                            meta: {
                                '_daextinma_seo_power': value,
                            },
                        });

                        // Used to rerender the component
                        this.setState({
                            seoPower: value,
                        });
                    }}
                    __nextHasNoMarginBottom={true}
                    __next40pxDefaultSize={true}
                    className="daextinma-interlinks-options-custom-margin"
                />

            </PluginDocumentSettingPanel>
        );
    }
}