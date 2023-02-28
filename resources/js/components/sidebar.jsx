import { useState } from 'react';
import {navLinksSet1, navLinksSet2, navLinksSet3, } from '../static/sidebarLinks.js'
import SidebarNavLink from "./links/sidebarNavLink";

const Sidebar = () => {
    const [NavLinksSet1, setNavLinksSet1 ] = useState(navLinksSet1)
    const [NavLinksSet2, setNavLinksSet2 ] = useState(navLinksSet2)
    const [NavLinksSet3, setNavLinksSet3 ] = useState(navLinksSet3)
    
    return (
        <nav className=" min-h-screen w-56 bg-primary ">
            <div className="p-4 mt-16 text-white space-y-2">
                <div className="flex flex-col flex-wrap space-y-2 text-sm">
                    <div className=" font-semibold">
                        ST. ANTHONY MEMORIAL HOSPITAL,
                    </div>
                    <div className="">DANSOMAN - ACCRA.</div>
                </div>
                <hr />

                <SidebarNavLink NavLinks={NavLinksSet1} setNavLinks={setNavLinksSet1} />
                <hr />
                <SidebarNavLink NavLinks={NavLinksSet2} setNavLinks={setNavLinksSet2} />
                <hr />
                <SidebarNavLink NavLinks={NavLinksSet3} setNavLinks={setNavLinksSet3} />
            </div>
        </nav>
    );
};

export default Sidebar;
