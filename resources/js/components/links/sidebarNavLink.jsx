import { useState } from "react";
import { NavLink } from "react-router-dom";
import SubMenu from "./subMenu";

const SidebarNavLink = ({ NavLinks, setNavLinks }) => {
   
    function handleIncrementClick(index) {
        const nextCounters = NavLinks.map((Nav, id) => {
          if (id === index) {
            
            return {...Nav, toggle : !Nav.toggle};
          } else {
            
            return Nav;
          }
        });
        
        setNavLinks(nextCounters);
      }
    
    
   
    return (
        <>
            <ul className="">
                { NavLinks.map((Nav, index) => {
                    return (
                        <li key={index}>
                            {Nav.subLinks ? (
                                <div>
                                    <div className="flex px-2 font-semibold py-2 rounded-lg hover:bg-blue-600 active:bg-blue-600 space-x-2 cursor-pointer" onClick={() => {handleIncrementClick(index);}}>
                                        <span>{Nav.icon}</span>
                                        <span>{Nav.name}</span>
                                    </div>
                                    { Nav.toggle && <ul>
                                        <SubMenu subMenuLinks={Nav.subLinks}  />
                                    </ul>}
                                </div>
                            ) : (
                                <NavLink
                                    to={Nav.path}
                                    className="flex px-2 font-semibold py-2 rounded-lg hover:bg-blue-600 active:bg-blue-600 space-x-2"
                                >
                                    <span>{Nav.icon}</span>
                                    <span>{Nav.name}</span>
                                </NavLink>
                            )}
                        </li>
                    );
                }
                )}
            </ul>
        </>
    );
};

export default SidebarNavLink;
