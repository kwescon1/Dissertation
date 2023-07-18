import Table from "../../components/tables/table";
import PageTitle from "../../components/typography/pagetitle";
import PageContainer from "../../layouts/pageContainer";
import moment from 'moment';
import { getAuthUser } from "../../services/storage";
import { FaEye, FaEdit, FaTrash } from "react-icons/fa";
import { useEffect,useState } from "react";
import DeleteModal from "../../components/modals/delete";
import { Link } from "react-router-dom";
import {ToastContainer } from 'react-toastify';
import { successNotif,errorNotif } from "../../services/toast";

const getClients = async () => {
  try {
    const response = await axios.get("clients");


    return response?.data?.data;
  } catch (error) {
      console.log(error);
  }
}

const AllClients = () => {

  const [clients, setClients] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const [user, setUser] = useState(null);
  const viewClient = "view-clients";
  const editClient = "edit-clients";
  const deleteClient = "delete-clients";
  const [selectedClient,setSelectedClient] = useState(null);
  const [showDeleteModal, setShowDeleteModal] = useState(false);

  useEffect(() => {
    const authUser = getAuthUser();
    // This function should return the authenticated user if it exists

    setUser(authUser);

        getClients().then((data) => {
            setClients(data);
            setIsLoading(false);
        });
  },[]);

  const handleDeleteClick = (client) => {
    setSelectedClient(client);
    setShowDeleteModal(true);
};

const confirmDelete = async () => {
  try {
      const response = await axios.delete(`clients/${selectedClient.id}`);
      successNotif("Client successfully deleted");

      //reload users
      setClients(clients.filter((client) => client.id !== selectedClient.id));
      setSelectedClient(null);
      setShowDeleteModal(false);
      getClients(); // reload the roles after delete
  } catch (error) {
    
      setShowDeleteModal(false);
      // setError(error);
      errorNotif(error.response.data.error);
    
  }
};
  const canViewClient = () => {
    return user?.role?.permissions.some(
        (permission) =>
            permission.name === viewClient || permission.name === editClient
    );
};

const canEditClient = (row) => {
    return user?.role?.permissions.some(
        (permission) => permission.name === editClient
    );
};

const canDeleteClient = (row) => {
    return user?.role?.permissions.some(
        (permission) => permission.name === deleteClient
    ) && row.id !== user?.id;
};

  const columns = [
    {
      name: 'NHS Number',
      selector: row => row.nhs_number,
      sortable: true,
    },
    {
      name: 'Last Name',
      selector: row => row.lastname,
      sortable: true,
    },
    {
      name: 'Other Names',
      cell: (row) => {if(row.othernames == null || row.othernames == "undefined"){return `${row.firstname}` }else{ return  `${row.firstname} ${row.othernames}`} },
      
    },
    {
      name: 'Sex',
      selector: row => row.sex
    },
    {
      name: 'Date Registered',
      selector: row => moment(row.date_registered).format('DD MMM YYYY') ,
    },
    {
      name: "Actions",
      cell: (row) => (
          <div className="flex flex-wrap space-x-4">
              {(canViewClient() || canEditClient()) && (
                <Link
                to={`/clients/${row.id}/view`}
                className="text-primary cursor-pointer hover:text-primary-100"
              >

<FaEye />
</Link>
              )}

              {canEditClient() && (
                  <FaEdit className="text-primary cursor-pointer hover:text-primary-100" />
              )}

              {canDeleteClient(row) && (
                  <FaTrash
                      className="text-primary cursor-pointer hover:text-primary-100"
                      onClick={() => handleDeleteClick(row)}
                  />
              )}
          </div>
      ),
  },
  ];

  if (isLoading) {
    return <div>Loading...</div>;
}
  return ( 
    <div>
      <PageContainer>
        <PageTitle title="Clients"/>
        <Table columns={columns} data={clients} />
        <DeleteModal
                    show={showDeleteModal}
                    title="Delete Client"
                    onClose={(event) => setShowDeleteModal(false)}
                    onDelete={(event) => confirmDelete()}
                    message="Are you sure you want to delete client"
                    name={`${selectedClient?.firstname} ${selectedClient?.lastname} ${selectedClient?.lastname}`}
                />
      </PageContainer>
      <ToastContainer />
    </div>
   );
}
 
export default AllClients;