import { Form } from "react-router-dom";
import AuthBackground from "../../components/authCard";
import AuthButton from "../../components/buttons/authbutton";
import AuthInput from "../../components/inputs/authInput";
import setNewPasswordImage from '../../../images/setnewpasswordimg.png'


const SetNewPassword = () => {
    return ( 
        <div className=" ">
            <AuthBackground imagesource={setNewPasswordImage}>
                <div className="space-y-6">
                    <span className="font-medium ">Set your new password</span>
                    <Form className="space-y-4">
                        <AuthInput type="password" placeholder="Old Password"  name="oldPassword"  />
                        <AuthInput type="password" placeholder="New Password"  name="newPassword"  />
                        <AuthInput type="password" placeholder="Confirm New Password"  name="confirmNewPassword"  />
                        <AuthButton btnText="Save Password" linkText="Back to Login" linkTo="/login"  />
                    </Form>
                    
                </div>
               
            </AuthBackground>
        </div>
     );
}
 
export default SetNewPassword;