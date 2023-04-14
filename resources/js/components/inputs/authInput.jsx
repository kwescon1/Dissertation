const AuthInput = ({ type, placeholder, name,value,onchange }) => {
    return (
        <div>
            <input
                className="form-input rounded border-primary-75"
                type={type}
                placeholder={placeholder}
                name={name}
                value={value}
                onChange={onchange}
            />
        </div>
    );
};

export default AuthInput;
