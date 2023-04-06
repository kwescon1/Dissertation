
import Table from "../../../components/tables/table";
import PageTitle from "../../../components/typography/pagetitle";
import PageContainer from "../../../layouts/pagecontaner";
import Users from '../../../static/users.json'

const AllUsers = () => {
  const columns = [
    {
      name: 'Name',
      selector: row => `${row.firstname} ${row.lastname}`,
      sortable: true,
    },
    {
      name: 'Username',
      selector: row => row.username,
      
    },
    {
      name: 'Status',
      cell: (row) => row.status,
      
    },
    
    {
      name: 'Actions',
      cell: (row) => <div className="flex flex-wrap space-x-4">
        <button className=" text-primary font-semibold text-base hover:text-primary-100 hover:underline">View</button>
        <button className=" text-primary font-semibold text-base hover:text-primary-100 hover:underline">Edit</button>
        <button className=" text-primary font-semibold text-base hover:text-primary-100 hover:underline">Delete</button>
      </div>,
    
    },
  ];
  
  return (  
    <div>
      <PageContainer>
        <PageTitle title="Users"/>
        <Table columns={columns} data={Users} />
      </PageContainer>
    </div>
    
    
  );
}
 
export default AllUsers;