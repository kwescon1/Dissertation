const AuthInput = ({ type, placeholder, name }) => {
    return ( 
        <div>
            <input className="form-input rounded outline-gray-100" type={type} placeholder={placeholder}  name={name}/>
        </div>
     );
}
 
export default AuthInput;