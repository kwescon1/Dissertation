import Logo from "./logo/authLogo";

const AuthBackground = ({ children, imagesource }) => {
    return (
        <div className="flex items-center min-h-screen">
            <div className="container">
                <div className="  bg-primary-10 flex flex-wrap h-full">
                    <div className="w-2/5 flex flex-col items-center justify-center space-y-20">
                        <Logo />

                        <div className="">{children}</div>
                    </div>
                    <div className="w-3/5">
                        <img
                            src={imagesource}
                            className="object-cover w-full h-full"
                        />
                    </div>
                </div>
            </div>
        </div>
    );
};

export default AuthBackground;
