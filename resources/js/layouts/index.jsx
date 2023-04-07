import { useState,useEffect } from 'react';
import NavBar from "../components/navbar";
import Sidebar from "../components/sidebar";
import { setHeader } from "../services/token";
import { getAuthUser } from "../services/storage";
import { useNavigate ,Outlet} from "react-router-dom";

function Index(){
    const navigate = useNavigate();
    const [user, setUser] = useState(null);

    useEffect(() => {
        
        const user = getAuthUser(); // This function should return the authentication user if it exists

        if (user) {
            setUser(user);
            //set default headers if user is authenticated
            axios.defaults.headers = setHeader(true);
          } else {
            setUser(null);
            navigate("/login", { replace: true });
           }

      }, [navigate]);
    
    if(!user) {
        return null;
    }
    return (
        <div className="relative">
          <NavBar />
          <div className="flex w-full mt-16 z-0">
            <div className="w-72">
              <Sidebar />
            </div>
            <div className=" w-full">
              <Outlet />
            </div>
          </div>
        </div>
      );
  
};

export default Index;


