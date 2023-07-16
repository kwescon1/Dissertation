import Table from "../../../components/tables/table";
import PageTitle from "../../../components/typography/pageTitle";
import PageContainer from "../../../layouts/pageContainer";
import { getAuthUser } from "../../../services/storage";
import { FaEye, FaEdit, FaTrash } from "react-icons/fa";
import { useEffect, useState } from "react";
import DeleteModal from "../../../components/modals/delete";
import { Link } from "react-router-dom";
import { ToastContainer } from 'react-toastify';
import { successNotif, errorNotif } from "../../../services/toast";

const getCategories = async () => {
  try {
    const response = await axios.get("categories");

    return response?.data;
  } catch (error) {
    console.log(error);
  }
}

const AllCategories = () => {

  const [categories, setCategories] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const [user, setUser] = useState(null);

  const [selectedCategory, setSelectedCategory] = useState(null);
  const [showDeleteModal, setShowDeleteModal] = useState(false);

  useEffect(() => {
    const authUser = getAuthUser();
    // This function should return the authenticated user if it exists

    setUser(authUser);
    getCategories().then((data) => {
      setCategories(data);
      setIsLoading(false);
    });
  }, []);

  const handleDeleteClick = (cat) => {
    setSelectedCategory(cat);
    setShowDeleteModal(true);
  };

  const confirmDelete = async () => {
    try {
      const response = await axios.delete(`clients/${selectedClient.id}`);
      successNotif("Client successfully deleted");

      //reload users
      setAppointments(categories.filter((category) => category.id !== selectedCategory.id));
      setSelectedCategory(null);
      setShowDeleteModal(false);
      getCategories(); // reload the roles after delete
    } catch (error) {

      setShowDeleteModal(false);
      // setError(error);
      errorNotif(error.response.data.error);

    }
  };

  const columns = [
    {
      name: 'Name',
      cell: (row) => row.name

    },
    {
      name: 'Status',
      selector: row => row.status
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
        <PageTitle title="Inventory Categories" />
        <div className="flex flex-wrap mb-6 justify-end">
          <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">New Category</button>
        </div>
        <Table columns={columns} data={categories} />
        <DeleteModal
          show={showDeleteModal}
          title="Delete Category"
          onClose={(event) => setShowDeleteModal(false)}
          onDelete={(event) => confirmDelete()}
          message="Are you sure you want to delete category"
          name={`${selectedCategory?.name}`}
        />
      </PageContainer>
      <ToastContainer />
    </div>
  );
}

export default AllCategories;