import { createBrowserRouter } from "react-router-dom";
import Index from "../layouts/index";
import AllAppointments from "../pages/appointments/allAppointments";
import ForgotPassword from "../pages/auth/forgotPassword";
import Login from "../pages/auth/login";
import ResetPassword from "../pages/auth/resetPassword";
import SetNewPassword from "../pages/auth/setNewPassword";
import AddClient from "../pages/clients/addClient";
import AllClients from "../pages/clients/allClients";
import Dashboard from "../pages/dashboard/dashboard";
import AllCategories from "../pages/inventories/categories/allCategories";
import AllItems from "../pages/inventories/items/allItems";
import AllRoles from "../pages/users&roles/roles/allRoles";
import AllUsers from "../pages/users&roles/users/allUsers";
import WaitingList from "../pages/waitingLists/waitingList";
import ViewRole from "../pages/users&roles/roles/viewRole";
import AddUser from "../pages/users&roles/users/addUser";
import EditUser from "../pages/users&roles/users/editUser";
import ViewUser from "../pages/users&roles/users/viewUser";
import AddRole from "../pages/users&roles/roles/addRole";
import EditRole from "../pages/users&roles/roles/editRole";
import ViewClient from "../pages/clients/viewClient";
import AddRecord from "../pages/records/addRecord";
import AddAppointment from "../pages/appointments/addAppointment";
import EditAppointment from "../pages/appointments/editAppointment";
import ViewAppointment from "../pages/appointments/viewAppointment";

const routes = createBrowserRouter([
    {
        element: <Index />,
        children: [
            {
                path: "/",
                children: [
                    {
                        index: true,
                        element: <Dashboard />,
                    },

                    {
                        path: "appointments",

                        children: [
                            {
                                index: true,
                                element: <AllAppointments />,
                            },
                            {
                                path: "new",
                                element: <AddAppointment />,
                            },
                            {
                                path: "edit",
                                element: <EditAppointment />,
                            },
                            {
                                path: "view",
                                element: <ViewAppointment />,
                            },
                        ],
                    },
                    {
                        path: "clients",
                        children: [
                            {
                                index: true,
                                element: <AllClients />,
                            },
                            {
                                path: ":id/view",
                                element: <ViewClient />,
                            },
                        ],
                    },

                    {
                        path: "inventories",
                        children: [
                            {
                                path: "categories",
                                children: [
                                    {
                                        index: true,
                                        element: <AllCategories />,
                                    },
                                ],
                            },
                            {
                                path: "items",
                                children: [
                                    {
                                        index: true,
                                        element: <AllItems />,
                                    },
                                ],
                            },
                        ],
                    },

                    {
                        path: "roles",

                        children: [
                            {
                                index: true,
                                element: <AllRoles />,
                            },
                            {
                                path: ":id/view",
                                element: <ViewRole />,
                            },
                            {
                                path: "edit",
                                element: <EditRole />,
                            },
                            {
                                path: "new",
                                element: <AddRole />,
                            },
                        ],
                    },
                    {
                        path: "users",
                        children: [
                            {
                                index: true,
                                element: <AllUsers />,
                            },
                            {
                                path: "new",
                                element: <AddUser />,
                            },
                            {
                                path: ":id/edit",
                                element: <EditUser />,
                            },
                            {
                                path: ":id/view",
                                element: <ViewUser />,
                            },
                        ],
                    },
                    {
                        path: "waitinglist",
                        children: [
                            {
                                index: true,
                                element: <WaitingList />,
                            },
                        ],
                    },
                    {
                        path: "records",

                        children: [
                            // {
                            //     index: true,
                            //     element: <AllRoles />,
                            // },
                            // {
                            //     path: ":id/view",
                            //     element: <ViewRole />,
                            // },
                            // {
                            //     path: "edit",
                            //     element: <EditRole />,
                            // },
                            {
                                path: "new",
                                element: <AddRecord />,
                            },
                        ],
                    },
                ],
            },
        ],
    },
    {
        path: "/client-registration-link/:facilityId/:branchId/:client/:hash",
        element: <AddClient />,
    },
    {
        path: "/login",
        element: <Login />,
    },
    {
        path: "/password/forgot",
        element: <ForgotPassword />,
    },
    {
        path: "/password/reset",
        element: <ResetPassword />,
    },
    {
        path: "/password/new",
        element: <SetNewPassword />,
    },
]);

export default routes;
