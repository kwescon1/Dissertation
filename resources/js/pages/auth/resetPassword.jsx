import { Form } from "react-router-dom";
import AuthBackground from "../../components/authCard";
import AuthButton from "../../components/buttons/authbutton";
import AuthInput from "../../components/inputs/authInput";
import resetPasswordImage from '../../../images/resetpasswordimg.png'

const ResetPassword = () => {
    return ( 
        <div className=" ">
            <AuthBackground imagesource={resetPasswordImage}>
                <div className="space-y-6">
                    <span className="font-medium ">Set your new password</span>
                    <Form className="space-y-4">
                        <AuthInput type="password" placeholder="Password"  name="password"  />
                        <AuthInput type="password" placeholder="Confirm Password"  name="confirmPassword"  />
                        <AuthButton btnText="Save Password" linkText="Back to Login" linkTo="/login"  />
                    </Form>
                    
                </div>
               
            </AuthBackground>
        </div>
     );
}
 
export default ResetPassword;