import { Navigate, Outlet } from "react-router-dom";
import NavBar from "../components/navbar";
import Sidebar from "../components/sidebar";

const Index = () => {
    return (
        <>
         {/* <Navigate to="/login" replace={true} /> */}
         <div className="relative">
            <NavBar />
            <div className="flex w-full mt-16 z-0">
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
