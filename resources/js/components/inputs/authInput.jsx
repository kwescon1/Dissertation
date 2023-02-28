const AuthInput = ({ type, placeholder, name }) => {
    return (
        <div>
            <input
                className="form-input rounded border-primary-75"
                type={type}
                placeholder={placeholder}
                name={name}
            />
        </div>
    );
};

export default AuthInput;
