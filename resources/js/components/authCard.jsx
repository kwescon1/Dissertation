import Logo from "./logo/authLogo";

const AuthBackground = ({ children }) => {
    return (
        <div className="grid place-content-center h-screen ">
            <div className="bg-primary-10 rounded-md py-12 px-8 space-y-8 text-center grid justify-items-center">
                <Logo />
                <div>{children}</div>
            </div>
        </div>
    );
};

export default AuthBackground;
