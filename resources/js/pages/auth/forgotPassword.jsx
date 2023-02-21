import { Form } from "react-router-dom";
import AuthBackground from "../../components/authBackground";
import AuthButton from "../../components/authbutton";
import AuthInput from "../../components/authInput";

const ForgotPassword = () => {
    return ( 
        <div className=" ">
            <AuthBackground>
                <div className="space-y-6">
                    <span className="font-medium ">Provide your username</span>
                    <Form className="space-y-4">
                        <AuthInput type="text" placeholder="Username"  name="username"  />
                        <AuthButton btnText="Reset Password" linkText="Back to Login" linkTo="/login"  />
                    </Form>
                    
                </div>
               
            </AuthBackground>
        </div>
     );
}
 
export default ForgotPassword;