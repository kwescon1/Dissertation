import { Navigate } from "react-router-dom";
import NavBar from "../components/navbar";
import Sidebar from "../components/sidebar";

const Index = () => {
    return (
        <div className="relative">
            <NavBar />
            {/* <Navigate to="/login" replace={true} /> */}
            <div className="flex">
                <Sidebar />
            </div>
        </div>
    );
};

export default Index;
