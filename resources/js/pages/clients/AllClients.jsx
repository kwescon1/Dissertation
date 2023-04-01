import Table from "../../components/tables/table";
import PageTitle from "../../components/typography/pagetitle";
import PageContainer from "../../layouts/pagecontaner";
import client from '../../static/client.json'
import moment from 'moment';

const AllClients = () => {
  const columns = [
    {
      name: 'Client Number',
      selector: row => row.client_id,
      sortable: true,
    },
    {
      name: 'Last Name',
      selector: row => row.lastname,
      sortable: true,
    },
    {
      name: 'Other Names',
      cell: (row) => `${row.firstname} ${row.othername}`,
      
    },
    {
      name: 'Sex',
      selector: row => {if(row.sex === "Male"){return "M"} else if(row.sex === "Female"){return "F"} else return "O"},
    },
    {
      name: 'Date Registered',
      selector: row => moment(row.date_registered).format('DD MMM YYYY') ,
    },
    {
      name: 'Actions',
      cell: (row) => <div className="flex flex-wrap space-x-4">
        <button className=" text-primary font-semibold text-base hover:text-primary-100 hover:underline">View</button>
        <button className=" text-primary font-semibold text-base hover:text-primary-100 hover:underline">Delete</button>
      </div>,
    
    },
  ];
  
  return ( 
    <div>
      <PageContainer>
        <PageTitle title="Clients"/>
        <Table columns={columns} data={client} />
      </PageContainer>
    </div>
   );
}
 
export default AllClients;