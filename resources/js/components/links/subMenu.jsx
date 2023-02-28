import { NavLink } from "react-router-dom";
const SubMenu = ({subMenuLinks}) => {
    return (
        <>
            {subMenuLinks.map((subNav, index) => {
                return (
                    <li key={index}>
                        <NavLink
                            to={subNav.path}
                            className={({ isActive }) => isActive ? "flex px-10 font-semibold py-2 rounded-lg bg-blue-600 space-x-2" : "flex px-10 font-semibold py-2 rounded-lg hover:bg-blue-600  space-x-2"}
                                
                        >
                            <span>{subNav.name}</span>
                        </NavLink>
                    </li>
                );
            })}
        </>
    );
};

export default SubMenu;
