import Table from "../../../components/tables/table";
import PageTitle from "../../../components/typography/pagetitle";
import PageContainer from "../../../layouts/pagecontaner";
import Roles from '../../../static/roles.json'


const AllRoles = () => {
  const columns = [
    {
      name: 'Name',
      selector: row => row.name,
      sortable: true,
    },
    {
      name: 'Description',
      selector: row => row.description,
      maxWidth: '600px',
      wrap: true,
      
    },
    {
      name: 'Number of Users',
      cell: (row) => row.number_of_users,
      
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
        <PageTitle title="Roles"/>
        <Table columns={columns} data={Roles} />
      </PageContainer>
    </div>
   );
}
 
export default AllRoles;