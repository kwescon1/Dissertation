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

const routes = createBrowserRouter([
    {
        path: "/",
        element: <Index />,
        children: [
            {
                path: "appointments",
                element: <AllAppointments />,
            },
            {
                path: "clients",
                element: <AllClients />,
            },

            {
                path: "dashboard",
                element: <Dashboard />,
            },
            {
                path: "inventories",
                children: [
                    {
                        path: "categories",
                        element: <AllCategories />,
                    },
                    {
                        path: "items",
                        element: <AllItems />,
                    },
                ],
            },
            {
                path: "sales",
                children: [
                    {
                        path: "customers",
                        element: <AllCustomers />,
                    },
                    {
                        path: "invoices",
                        element: <AllInvoices />,
                    },
                    {
                        path: "receipt",
                        element: <AllReceipts />,
                    },
                    {
                        path: "transactions",
                        element: <AllTransactions />,
                    },
                ],
            },
            {
                path: "providers",
                element: <AllProviders />,
            },
            {
                path: "services",
                element: <AllServices />,
            },
            {
                path: "settings",
                element: <TempSettings />,
            },
            {
                path: "roles",
                element: <AllRoles />,
            },
            {
                path: "users",
                element: <AllUsers />,
            },
            {
                path: "waitinglist",
                element: <WaitingList />,
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
