import { Navigate, Outlet } from "react-router-dom";
import { useEffect } from 'react';
import NavBar from "../components/navbar";
import Sidebar from "../components/sidebar";
import { setHeader } from "../services/token";



const Index = () => {

    useEffect(() => {
        //set default headers if user is authenticated
        axios.defaults.headers = setHeader(true);
      }, []);

    return (
        <>
         {/* <Navigate to="/login" replace={true} /> */}
         <div className="relative">
            <NavBar />
            <div className="flex w-full mt-16">
                <div className="w-72">
                <Sidebar />
                </div>
                
                <div className=" w-full">
                    <Outlet  />
                    
                </div>

            </div>
        </div>
        </>
        
    );
};

export default Index;
