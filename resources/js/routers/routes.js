import { createBrowserRouter } from "react-router-dom";
import Index from "../layouts/index";
import AllAppointments from "../pages/appointments/allAppointments";
import ForgotPassword from "../pages/auth/forgotPassword";
import Login from "../pages/auth/login";
import ResetPassword from "../pages/auth/resetPassword";
import SetNewPassword from "../pages/auth/setNewPassword";
import AddClient from "../pages/clients/addclient";
import AllClients from "../pages/clients/allclients";
import Dashboard from "../pages/dashboard/dashboard";
import AllCategories from "../pages/inventories/categories/allCategories";
import AllItems from "../pages/inventories/items/allItems";
import AllCustomers from "../pages/sales/customers/allCustomers";
import AllInvoices from "../pages/sales/invoices/allInvoices";
import AllReceipts from "../pages/sales/receipts/allReceipts";
import AllTransactions from "../pages/sales/transactions/allTransaction";
import AllProviders from "../pages/services&providers/providers/allproviders";
import AllServices from "../pages/services&providers/services/allServices";
import TempSettings from "../pages/settings/tempSettings";
import AllRoles from "../pages/users&roles/roles/allRoles";
import AllUsers from "../pages/users&roles/users/allUsers";
import WaitingList from "../pages/waitingLists/waitingList";
import ViewRole from "../pages/users&roles/roles/viewRole";
import AddUser from "../pages/users&roles/users/addUser";
import EditUser from "../pages/users&roles/users/editUser";
import ViewUser from "../pages/users&roles/users/viewUser";
import AddRole from "../pages/users&roles/roles/addRole";
import EditRole from "../pages/users&roles/roles/editRole";

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
                        path: "dashboard",
                        element: <Dashboard />,
                    },
                    {
                        path: "appointments",

                        children: [
                            {
                                index: true,
                                element: <AllAppointments />,
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
                        path: "sales",
                        children: [
                            {
                                path: "customers",
                                children: [
                                    {
                                        index: true,
                                        element: <AllCustomers />,
                                    },
                                ],
                            },
                            {
                                path: "invoices",
                                children: [
                                    {
                                        index: true,
                                        element: <AllInvoices />,
                                    },
                                ],
                            },
                            {
                                path: "receipt",
                                children: [
                                    {
                                        index: true,
                                        element: <AllReceipts />,
                                    },
                                ],
                            },
                            {
                                path: "transactions",
                                children: [
                                    {
                                        index: true,
                                        element: <AllTransactions />,
                                    },
                                ],
                            },
                        ],
                    },
                    {
                        path: "providers",
                        children: [
                            {
                                index: true,
                                element: <AllProviders />,
                            },
                        ],
                    },
                    {
                        path: "services",
                        children: [
                            {
                                index: true,
                                element: <AllServices />,
                            },
                        ],
                    },
                    {
                        path: "settings",
                        children: [
                            {
                                index: true,
                                element: <TempSettings />,
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
                                path: "edit",
                                element: <EditUser />,
                            },
                            {
                                path: "view",
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
