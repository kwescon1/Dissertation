import { createBrowserRouter } from "react-router-dom";
import Index from "../pages";
import ForgotPassword from "../pages/auth/forgotPassword";
import Login from "../pages/auth/login";
import ResetPassword from "../pages/auth/resetPassword";
import SetNewPassword from "../pages/auth/setNewPassword";


  
  const routes = createBrowserRouter([
    {
      path: "/",
      element: <Index  />,
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

export default routes