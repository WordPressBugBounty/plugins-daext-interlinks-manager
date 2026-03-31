const useState = wp.element.useState;
import Pagination from '../../../shared-components/pagination/Pagination';

const useMemo = wp.element.useMemo;
const {__} = wp.i18n;

let PageSize = 10;

const Chart = (props) => {

    //Pagination - START --------------------------------------------------------

    const [currentPage, setCurrentPage] = useState(1);

    const currentTableData = useMemo(() => {
        const firstPageIndex = (currentPage - 1) * PageSize;
        const lastPageIndex = firstPageIndex + PageSize;
        return props.data.slice(firstPageIndex, lastPageIndex);
    }, [currentPage, props.data]);

    //Pagination - END ----------------------------------------------------------

    function handleDataIcon(columnName) {

        return props.formData.sortingColumn === columnName ? props.formData.sortingOrder : '';

    }

    /**
     * Format the internal links status as "X of Y", where X is the total number of internal links (manual + auto)
     * and Y is the recommended number of internal links based on content length.
     */
    function formatInternalLinksStatus(manualInterlinks, recommendedInterlinks) {

        const internalLinks = parseInt(manualInterlinks, 10);

        return internalLinks + ' of ' + recommendedInterlinks;

    }

    /**
     * Return the CSS class for the internal links optimization status icon.
     *
     * 1 => Green circle (optimized)
     * 0 => Red circle (not optimized)
     *
     * No data => Grey circle (not currently used in this context).
     */
    function getInternalLinksStatusClass(optimization) {

        let color_code_class = '';
        if (parseInt(optimization, 10) === 1) {
            color_code_class = 'daextinma-react-table__check-circle';
        } else {
            color_code_class = 'daextinma-react-table__x-circle';
        }

        return color_code_class;

    }

    /**
     * Build the tooltip text for the internal links status cell.
     *
     * Example: "2 internal links. Recommended: 7."
     */
    function getInternalLinksTooltip(manualInterlinks, recommendedInterlinks) {

        const internalLinks = parseInt(manualInterlinks, 10);

        return internalLinks + ' internal links. Recommended: ' + recommendedInterlinks + '.';

    }

    return (

        <div className="daextinma-data-table-container">

            <table className="daextinma-react-table__daextinma-data-table daextinma-react-table__daextinma-data-table-dashboard-menu">
                <thead>
                <tr>
                    <th>
                        <button
                            className={'daextinma-react-table__daextinma-sorting-button'}
                            onClick={props.handleSortingChanges}
                            value={'post_title'}
                            data-icon={handleDataIcon('post_title')}
                            title={__('The title of the post or page.', 'daext-interlinks-manager')}
                        >{__('Post', 'daext-interlinks-manager')}</button>
                    </th>
                    <th>
                        <button
                            className={'daextinma-react-table__daextinma-sorting-button'}
                            onClick={props.handleSortingChanges}
                            value={'post_date'}
                            data-icon={handleDataIcon('post_date')}
                            title={__('The publication date of the post or page.', 'daext-interlinks-manager')}
                        >{__('Date', 'daext-interlinks-manager')}</button>
                    </th>
                    <th>
                        <button
                            className={'daextinma-react-table__daextinma-sorting-button'}
                            onClick={props.handleSortingChanges}
                            value={'post_type'}
                            data-icon={handleDataIcon('post_type')}
                            title={__('The content type (e.g. post or page).', 'daext-interlinks-manager')}
                        >{__('Type', 'daext-interlinks-manager')}</button>
                    </th>
                    <th>
                        <button
                            className={'daextinma-react-table__daextinma-sorting-button'}
                            onClick={props.handleSortingChanges}
                            value={'content_length'}
                            data-icon={handleDataIcon('content_length')}
                            title={__('The content length of the post in characters.', 'daext-interlinks-manager')}
                        >{__('Length', 'daext-interlinks-manager')}</button>
                    </th>
                    <th>
                        <button
                            className={'daextinma-react-table__daextinma-sorting-button'}
                            onClick={props.handleSortingChanges}
                            value={'manual_interlinks'}
                            data-icon={handleDataIcon('manual_interlinks')}
                            title={__('The number of internal links in the post content.', 'daext-interlinks-manager')}
                        >{__('Internal Links', 'daext-interlinks-manager')}</button>
                    </th>
                    <th>
                        <button
                            className={'daextinma-react-table__daextinma-sorting-button'}
                            onClick={props.handleSortingChanges}
                            value={'iil'}
                            data-icon={handleDataIcon('iil')}
                            title={__('The number of internal links pointing to this post from other content.', 'daext-interlinks-manager')}
                        >{__('Inbound Links', 'daext-interlinks-manager')}</button>
                    </th>
                    <th>
                        <button
                            className={'daextinma-react-table__daextinma-sorting-button'}
                            onClick={props.handleSortingChanges}
                            value={'optimization'}
                            data-icon={handleDataIcon('optimization')}
                            title={__('Indicates whether the number of internal links is within the recommended range based on content length.', 'daext-interlinks-manager')}
                        >{__('Status', 'interlinks-manager')}</button>
                    </th>
                </tr>
                </thead>
                <tbody>

                {currentTableData.map((row) => (
                    <tr key={row.id}>
                        <td>
                            <div className={'daextinma-react-table__post-cell-container'}>
                                <a href={row.post_permalink}>
                                    {row.post_title}
                                </a>
                                <a href={row.post_permalink} target={'_blank'} className={'daextinma-react-table__icon-link'}></a>
                                <a href={row.post_edit_link} className={'daextinma-react-table__icon-link'}></a>
                            </div>
                        </td>
                        <td>{row.formatted_post_date}</td>
                        <td>{row.post_type}</td>
                        <td>{row.content_length}</td>
                        <td>{row.manual_interlinks}</td>
                        <td>{row.iil}</td>
                        <td>
                            <div
                                className={'daextinma-react-table__post-cell-container'}
                                title={getInternalLinksTooltip(
                                    row.manual_interlinks,
                                    row.recommended_interlinks
                                )}
                            >
                                <div className={'daextinma-circle ' + getInternalLinksStatusClass(row.optimization)}></div>
                                {formatInternalLinksStatus(
                                    row.manual_interlinks,
                                    row.recommended_interlinks
                                )}
                            </div>
                        </td>
                    </tr>
                ))}

                </tbody>
            </table>

            {props.data.length === 0 && <div
                className="daextinma-no-data-found">{__('We couldn\'t find any results matching your filters. Try adjusting your criteria.', 'daext-interlinks-manager')}</div>}
            {props.data.length > 0 &&
                <div className="daextinma-react-table__pagination-container">
                    <div className='daext-displaying-num'>{props.data.length + ' items'}</div>
                    <Pagination
                        className="pagination-bar"
                        currentPage={currentPage}
                        totalCount={props.data.length}
                        pageSize={PageSize}
                        onPageChange={page => setCurrentPage(page)}
                    />
                </div>
            }

        </div>

    );

};

export default Chart;
