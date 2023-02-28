import { useState } from "react";
import DropdownButton from "./buttons/dropdownButton";
import SearchInput from "./inputs/searchInput";
import Logo from "./logo/NavBarLogo";

const NavBar = () => {
    const [toggleNewBtn, setToggleNewBtn] = useState(false);
    const [toggleProfileBtn, setToggleProfileBtn] = useState(false);
    const newBtnDropdownContents = [
        {
            path: "/",
            name: "User",
        },
    ];
    const ProfileBtnDropdownContents = [
        {
            path: "/",
            name: "Profile",
        },
        {
            path: "/login",
            name: "Logout",
        },
    ];

    return (
        <nav className="fixed top-0 left-0 right-0">
            <div className="w-full h-16  bg-primary-5 border-b border-primary-25">
                <div className="mx-4 h-full flex items-center justify-between ">
                    <div className="w-full flex items-center space-x-10">
                        <Logo />
                        <SearchInput />
                        <DropdownButton
                            dropdownContents={newBtnDropdownContents}
                            dropdownPosition="left-0"
                            toggle={toggleNewBtn}
                            setToggle={setToggleNewBtn}
                        >
                            <div className="flex items-center bg-primary py-2 px-4 font-semibold text-white space-x-2 rounded-md hover:bg-primary-100">
                                <span>New</span>
                                {toggleNewBtn ? (
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        className="w-5 h-5"
                                    >
                                        <path
                                            fillRule="evenodd"
                                            d="M14.77 12.79a.75.75 0 01-1.06-.02L10 8.832 6.29 12.77a.75.75 0 11-1.08-1.04l4.25-4.5a.75.75 0 011.08 0l4.25 4.5a.75.75 0 01-.02 1.06z"
                                            clipRule="evenodd"
                                        />
                                    </svg>
                                ) : (
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        className="w-5 h-5"
                                    >
                                        <path
                                            fillRule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clipRule="evenodd"
                                        />
                                    </svg>
                                )}
                            </div>
                        </DropdownButton>
                    </div>

                    <div className="flex items-center space-x-6">
                        <button
                            type="button"
                            className="text-gray-300 hover:text-primary"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                strokeWidth={2}
                                stroke="currentColor"
                                className="w-8 h-8"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"
                                />
                            </svg>
                        </button>
                        <DropdownButton
                            dropdownContents={ProfileBtnDropdownContents}
                            dropdownPosition="right-0"
                            toggle={toggleProfileBtn}
                            setToggle={setToggleProfileBtn}
                        >
                            <div className="grid place-content-center h-8 w-8 rounded-full bg-gray-200 text-white hover:ring-1 hover:ring-primary focus:ring-1 focus:ring-primary ">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    className="w-6 h-6"
                                >
                                    <path
                                        fillRule="evenodd"
                                        d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                        clipRule="evenodd"
                                    />
                                </svg>
                            </div>
                        </DropdownButton>
                    </div>
                </div>
            </div>
        </nav>
    );
};

export default NavBar;
