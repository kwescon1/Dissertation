import { createBrowserRouter } from "react-router-dom";
import Index from "../layouts/index";
import ForgotPassword from "../pages/auth/forgotPassword";
import Login from "../pages/auth/login";
import ResetPassword from "../pages/auth/resetPassword";
import SetNewPassword from "../pages/auth/setNewPassword";
import AllUsers from "../pages/users/allUsers";


  
  const routes = createBrowserRouter([
    {
      path: "/",
      element: <Index  />,
      children: [
        {
          path: "users",
          element: <AllUsers />,
        },
      ],
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