import Table from "../../../components/tables/table";
import PageTitle from "../../../components/typography/pagetitle";
import PageContainer from "../../../layouts/pageContainer";
import { getAuthUser } from "../../../services/storage";
import { FaEye, FaEdit, FaTrash } from "react-icons/fa";
import { useEffect, useState } from "react";
import DeleteModal from "../../../components/modals/delete";
import { Link } from "react-router-dom";
import { ToastContainer } from 'react-toastify';
import { successNotif, errorNotif } from "../../../services/toast";

const getItems = async () => {
  try {
    const response = await axios.get("items");

    return response?.data;
  } catch (error) {
    console.log(error);
  }
}

const AllItems = () => {

  const [items, setItems] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const [user, setUser] = useState(null);

  const [selectedItem, setSelectedItem] = useState(null);
  const [showDeleteModal, setShowDeleteModal] = useState(false);

  useEffect(() => {
    const authUser = getAuthUser();
    // This function should return the authenticated user if it exists

    setUser(authUser);
    getItems().then((data) => {
      setItems(data);
      setIsLoading(false);
    });
  }, []);

  const handleDeleteClick = (cat) => {
    setSelectedItem(cat);
    setShowDeleteModal(true);
  };

  const confirmDelete = async () => {
    try {
      const response = await axios.delete(`clients/${selectedClient.id}`);
      successNotif("Client successfully deleted");

      //reload users
      setItems(items.filter((item) => item.id !== selectedItem.id));
      setSelectedItem(null);
      setShowDeleteModal(false);
      getItems(); // reload the roles after delete
    } catch (error) {

      setShowDeleteModal(false);
      // setError(error);
      errorNotif(error.response.data.error);

    }
  };

  const columns = [
    {
      name: 'Item Name',
      cell: (row) => row.item_name

    },
    {
      name: 'Category',
      selector: row => row.category
    },

    {
      name: 'Retail Price (GBP)',
      selector: row => row.retail_price
    },

    {
      name: 'Stock Level',
      selector: row => row.stock_level
    },

    {
      name: "Actions",
      cell: (row) => (
        <div className="flex flex-wrap space-x-4">

          <Link
            to={`/clients/${row.id}/view`}
            className="text-primary cursor-pointer hover:text-primary-100"
          >

            <FaEye />
          </Link>



          <FaEdit className="text-primary cursor-pointer hover:text-primary-100" />



          <FaTrash
            className="text-primary cursor-pointer hover:text-primary-100"
            onClick={() => handleDeleteClick(row)}
          />

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
        <PageTitle title="Inventory Items" />
        <div className="flex flex-wrap mb-6 justify-end">
          <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Manage Stock Levels</button>
        </div>
        <Table columns={columns} data={items} />
        <DeleteModal
          show={showDeleteModal}
          title="Delete Item"
          onClose={(event) => setShowDeleteModal(false)}
          onDelete={(event) => confirmDelete()}
          message="Are you sure you want to delete item"
          name={`${selectedItem?.item_name}`}
        />
      </PageContainer>
      <ToastContainer />
    </div>
  );
}

export default AllItems;