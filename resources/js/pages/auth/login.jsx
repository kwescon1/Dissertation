import AuthBackground from "../../components/authCard";
import AuthButton from "../../components/buttons/authbutton";
import AuthInput from "../../components/inputs/authInput";
import { useState } from "react";
import { encryptToken } from "../../services/token";
import {store} from "../../services/storage";
import loginImage from '../../../images/login.png'

function Login(){

    const [username,setUsername] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState(null);
   

    async function loginUser(event){
        event.preventDefault();
try{
    let data = {
        username: username,
        password: password
    };

const response = await axios.post('login',data);

let user = response?.data?.data;

// Encrypt the token
const encryptedToken = encryptToken(user.token);


user.token = encryptedToken;

//store user in localStorage
store(user);

// Redirect to the dashboard
window.location.href = '/';

}catch(error){
console.log(error);
}
    }


    return ( 
        <div className=" ">
            <AuthBackground imagesource={loginImage}>
                <div className=" space-y-6">
                    <div className="text-center">
                    <span className="font-medium py-8">Welcome, <br /> please log into your account</span>
                    </div>
                   
                    <form onSubmit={loginUser}className="space-y-4">
                        <AuthInput type="text" placeholder="Username"  name="username" value={username}
                        onchange={(event) => {
                            setUsername(event.target.value);
                        }}  />
                        <AuthInput type="password" placeholder="Password"  name="password" value={password}
                        onchange={(event) => {
                            setPassword(event.target.value);
                        }}  />
                        <AuthButton btnText="Login" linkText="Forgot Password" linkTo="/password/forgot"  />
                    </form>
                    
                </div>
               
            </AuthBackground>
        </div>
     );
}
 
export default Login;