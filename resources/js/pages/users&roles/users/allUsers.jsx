import { useEffect, useState } from "react";
import Table from "../../../components/tables/table";
import PageTitle from "../../../components/typography/pageTitle";
import PageContainer from "../../../layouts/pageContainer";
import { getAuthUser } from "../../../services/storage";
import { FaEye, FaEdit, FaTrash } from "react-icons/fa";
import DeleteModal from "../../../components/modals/delete";
import { Link } from "react-router-dom";
import {ToastContainer } from 'react-toastify';
import { successNotif,errorNotif }  from "../../../services/toast";


const getUsers = async () => {
    try {
        const response = await axios.get("users");

        return response?.data?.data;
    } catch (error) {
        console.log(error);
    }
};

const AllUsers = () => {
    const [users, setUsers] = useState([]);
    const [isLoading, setIsLoading] = useState(true);
    const [user, setUser] = useState(null);
    const viewUser = "view-users";
    const editUser = "edit-users";
    const deleteUser = "delete-users";
    const [selectedUser, setSelectedUser] = useState(null);
    const [showDeleteModal, setShowDeleteModal] = useState(false);
    const STATUS_PENDING = 0; // default on add new user
    const STATUS_ACTIVE = 1;
    const STATUS_SUSPENDED = 2;

    useEffect(() => {
        const authUser = getAuthUser();
        // This function should return the authenticated user if it exists

        setUser(authUser);

        getUsers().then((data) => {
            // console.log(data);
            setUsers(data);
            setIsLoading(false);
        });
    }, []);

    const handleDeleteClick = (user) => {
        setSelectedUser(user);
        setShowDeleteModal(true);
    };

    const confirmDelete = async () => {
        try {
            const response = await axios.delete(`users/${selectedUser.id}`);
        
            successNotif("User successfully deleted");


            //reload users
            setUsers(users.filter((user) => user.id !== selectedUser.id));
            setSelectedUser(null);
            setShowDeleteModal(false);
            getUsers(); // reload the roles after delete
        } catch (error) {
            setShowDeleteModal(false);
            // setError(error);

            errorNotif(error.response.data.error);
        }
    };
    const canViewUser = () => {
        return user?.role?.permissions.some(
            (permission) =>
                permission.name === viewUser || permission.name === editUser
        );
    };

    const canEditUser = (row) => {
        return user?.role?.permissions.some(
            (permission) => permission.name === editUser
        );
    };

    const canDeleteUser = (row) => {
        return (
            user?.role?.permissions.some(
                (permission) => permission.name === deleteUser
            ) && row.id !== user?.id
        );
    };

    const columns = [
        {
            name: "Name",
            selector: (row) => `${row.firstname} ${row.lastname}`,
            sortable: true,
        },
        {
            name: "Username",
            selector: (row) => row.username,
        },
        {
            name: "Role",
            selector: (row) => (Array.isArray(row.role) ? "NA" : row.role.name),
        },
        {
            name: "Status",
            cell: (row) => {
                switch (row.status) {
                    case STATUS_ACTIVE:
                        return "Active";
                        break;

                    case STATUS_SUSPENDED:
                        return "Suspended";
                        break;

                    default:
                        return "Pending";
                        break;
                }
            },
        },

        {
            name: "Actions",
            cell: (row) => (
                <div className="flex flex-wrap space-x-4">
                    {(canViewUser() || canEditUser()) && (
                        <Link to={`/users/${row.id}/view`}>
                            <FaEye className="text-primary cursor-pointer hover:text-primary-100" />
                        </Link>
                    )}

                    {canEditUser() && (
                        <Link to={`/users/edit`}>
                            <FaEdit className="text-primary cursor-pointer hover:text-primary-100" />
                        </Link>
                    )}

                    {canDeleteUser(row) && (
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
                <PageTitle title="Users" />
                <Table columns={columns} data={users} />
                <DeleteModal
                    show={showDeleteModal}
                    title="Delete User"
                    onClose={(event) => setShowDeleteModal(false)}
                    onDelete={(event) => confirmDelete()}
                    message="Are you sure you want to delete user"
                    name={`${selectedUser?.firstname} ${selectedUser?.lastname}`}
                />
            </PageContainer>
            <ToastContainer />
        </div>
    );
};

export default AllUsers;
