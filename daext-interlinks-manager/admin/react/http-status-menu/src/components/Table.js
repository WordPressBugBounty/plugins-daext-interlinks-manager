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
     * Get the color code for the HTTP status code.
     *
     * @param statusCode
     * @returns {string}
     */
    function getStatusCodeColorCode(statusCode) {

        if (/^1\d{2}\b/.test(statusCode)) {
            return 'daextinma-react-table__http-status-color-group-1xx-informational-responses';
        }

        if (/^2\d{2}\b/.test(statusCode)) {
            return 'daextinma-react-table__http-status-color-group-2xx-successful-responses';
        }
        
        if (/^3\d{2}\b/.test(statusCode)) {
            return 'daextinma-react-table__http-status-color-group-3xx-redirection-messages';
        }

        if (/^4\d{2}\b/.test(statusCode)) {
            return 'daextinma-react-table__http-status-color-group-4xx-client-error-responses';
        }

        if (/^5\d{2}\b/.test(statusCode)) {
            return 'daextinma-react-table__http-status-color-group-5xx-server-error-responses';
        }

        return 'daextinma-react-table__http-status-color-group-unknown';

    }

    return (

        <div className="daextinma-data-table-container">

            <table className="daextinma-react-table__daextinma-data-table daextinma-react-table__daextinma-data-table-http-status-menu">
                <thead>
                <tr>
                    <th>
                        <button
                            className={'daextinma-react-table__daextinma-sorting-button'}
                            onClick={props.handleSortingChanges}
                            value={'post_title'}
                            data-icon={handleDataIcon('post_title')}
                            title={__('The post where the link is located.', 'daext-interlinks-manager')}
                        >{__('Post', 'daext-interlinks-manager')}</button>
                    </th>
                    <th>
                        <button
                            className={'daextinma-react-table__daextinma-sorting-button'}
                            onClick={props.handleSortingChanges}
                            value={'anchor'}
                            data-icon={handleDataIcon('anchor')}
                            title={__('The anchor text of the link.', 'daext-interlinks-manager')}
                        >{__('Anchor Text', 'daext-interlinks-manager')}</button>
                    </th>
                    <th>
                        <button
                            className={'daextinma-react-table__daextinma-sorting-button'}
                            onClick={props.handleSortingChanges}
                            value={'url'}
                            data-icon={handleDataIcon('url')}
                            title={__('The destination URL of the link.', 'daext-interlinks-manager')}
                        >{__('URL', 'daext-interlinks-manager')}</button>
                    </th>
                    <th>
                        <button
                            className={'daextinma-react-table__daextinma-sorting-button'}
                            onClick={props.handleSortingChanges}
                            value={'code'}
                            data-icon={handleDataIcon('code')}
                            title={__('The HTTP status code returned when the URL was checked.', 'daext-interlinks-manager')}
                        >{__('Status Code', 'daext-interlinks-manager')}</button>
                    </th>
                    <th>
                        <button
                            className={'daextinma-react-table__daextinma-sorting-button'}
                            onClick={props.handleSortingChanges}
                            value={'last_check_date'}
                            data-icon={handleDataIcon('last_check_date')}
                            title={__('The date and time when the URL status was last checked.', 'daext-interlinks-manager')}
                        >{__('Last Check', 'daext-interlinks-manager')}</button>
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
                                <a href={row.post_permalink} target={'_blank'}
                                   className={'daextinma-react-table__icon-link'}></a>
                                <a href={row.post_edit_link} className={'daextinma-react-table__icon-link'}></a>
                            </div>
                        </td>
                        <td>{row.anchor}</td>
                        <td>
                            <div className={'daextinma-react-table__post-cell-container'}>
                                <a href={row.url}>
                                    {row.url}
                                </a>
                                <a href={row.url} target={'_blank'}
                                   className={'daextinma-react-table__icon-link'}></a>
                            </div>
                        </td>
                        <td>{row.code === '' ? __('N/A', 'daext-interlinks-manager') : <div className={'daextinma-react-table__http-status-pill ' + getStatusCodeColorCode(row.code)}>{row.code + ' ' +  row.code_description}</div>}</td>
                        <td>{row.code === '' ? __('Check in progress ...', 'daext-interlinks-manager') : row.formatted_last_check_date}</td>
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
