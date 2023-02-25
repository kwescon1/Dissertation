import { Navigate } from "react-router-dom";
import TitleBar from "../components/titlebar";

const Index = () => {
    return ( 
        <>
             {/* <Navigate to="/login" replace={true} /> */}
             <TitleBar  />
        </>
     );
}
 
export default Index;