import { Form } from "react-router-dom";
import AuthBackground from "../../components/authCard";
import AuthButton from "../../components/buttons/authButton";
import AuthInput from "../../components/inputs/authInput";

const Login = () => {
    return ( 
        <div className=" ">
            <AuthBackground>
                <div className="space-y-6">
                    <span className="font-medium ">Welcome, <br /> please log into your account</span>
                    <Form className="space-y-4">
                        <AuthInput type="text" placeholder="Username"  name="username"  />
                        <AuthInput type="password" placeholder="Password"  name="password"  />
                        <AuthButton btnText="Login" linkText="Forgot Password" linkTo="/password/forgot"  />
                    </Form>
                    
                </div>
               
            </AuthBackground>
        </div>
     );
}
 
export default Login;