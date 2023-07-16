import DataTable from 'react-data-table-component';
import DataTableExtensions from 'react-data-table-component-extensions';
import 'react-data-table-component-extensions/dist/index.css';

const customStyles = {
 
  headRow: {
		style: {
			backgroundColor: "#f3f4f6",
			
		}
  }
};
const Table = (props) => {
  const tableData = {
    columns:props.columns,
    data:props.data
  };
  

  return (
    <div className='border rounded shadow-md'> 
    <DataTableExtensions  {...tableData} export={false} print={false} filterPlaceholder='Search...' filterDigit={1} >
      
      <DataTable
    pagination
    {...props}
    customStyles={customStyles}
    />
    
    </DataTableExtensions>
    </div>
   );
}
 
export default Table;