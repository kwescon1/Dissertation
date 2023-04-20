import { useEffect, useState } from "react";
import Table from "../../../components/tables/table";
import PageTitle from "../../../components/typography/pagetitle";
import PageContainer from "../../../layouts/pagecontaner";
import { getAuthUser } from "../../../services/storage";
import { FaEye, FaEdit, FaTrash } from "react-icons/fa";
import DeleteModal from "../../../components/modals/delete";
import { Link } from 'react-router-dom';

// import { ToastContainer, toast } from 'react-toastify';

const getRoles = async () => {
    try {
        const response = await axios.get("roles");

        return response?.data?.data;
    } catch (error) {
        console.log(error);
    }
};

const AllRoles = () => {
  // const [errors,setError] = useState(null);
    const [roles, setRoles] = useState([]);
    const [isLoading, setIsLoading] = useState(true);
    const [user, setUser] = useState(null);
    const viewRole = "view-roles";
    const editRole = "edit-roles";
    const deleteRole = "delete-roles";
    const [selectedRole, setSelectedRole] = useState(null);
    const [showDeleteModal, setShowDeleteModal] = useState(false);

    useEffect(() => {
        const authUser = getAuthUser(); // This function should return the authenticated user if it exists

        setUser(authUser);

        getRoles().then((data) => {
            setRoles(data);
            setIsLoading(false);
        });
    }, []);

    const handleDeleteClick = (role) => {
        setSelectedRole(role);
        setShowDeleteModal(true);
    };

    const confirmDelete = async () => {
        try {
            const response = await axios.delete(`roles/${selectedRole.id}`);
            console.log("success"); //TODO show a success toast

            //reload roles
            setRoles(roles.filter((role) => role.id !== selectedRole.id));
            setSelectedRole(null);
            setShowDeleteModal(false);
            getRoles(); // reload the roles after delete
        } catch (error) {
          
            setShowDeleteModal(false);
            // setError(error);
            
// toast.error(error.response.data.error)
            console.log(error.response.data);
        }



        // let response = await axios.delete(`roles/${selectedRole.id}`);

        // console.log(response);
    };

    // const handleDeleteCancel = () => {
    //   setSelectedRole(null);
    //   setShowDeleteModal(false);
    // };

    const canViewRole = () => {
        return user?.role?.permissions.some(
            (permission) =>
                permission.name === viewRole || permission.name === editRole
        );
    };

    const canEditRole = () => {
        return user?.role?.permissions.some(
            (permission) => permission.name === editRole
        );
    };

    const canDeleteRole = () => {
        return user?.role?.permissions.some(
            (permission) => permission.name === deleteRole
        );
    };

    const columns = [
        {
            name: "Name",
            selector: (row) => row.name,
            sortable: true,
        },
        {
            name: "Description",
            selector: (row) => row.description,
            maxWidth: "600px",
            wrap: true,
        },
        {
            name: "Number of Users",
            cell: (row) => row.users_count,
        },

        {
            name: "Actions",
            cell: (row) => (
                <div className="flex flex-wrap space-x-4">
                    {(canViewRole() || canEditRole()) && (
                      <Link
                      to={`/roles/${row.id}/view`}
                      className="text-primary cursor-pointer hover:text-primary-100"
                    >

<FaEye />
</Link>
                    )}

                    {canEditRole() && (
                         <Link to={`/roles/edit`}>
                        <FaEdit className="text-primary cursor-pointer hover:text-primary-100" />
                         </Link>
                    )}

                    {canDeleteRole(row) && (
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
                <PageTitle title="Roles" />
                <Table columns={columns} data={roles} />
                <DeleteModal
                    show={showDeleteModal}
                    title="Delete Role"
                    onClose={(event) => setShowDeleteModal(false)}
                    onDelete={(event) => confirmDelete()}
                    message="Are you sure you want to delete role"
                    name={selectedRole?.name}
                />
            </PageContainer>
        </div>
    );
};

export default AllRoles;
