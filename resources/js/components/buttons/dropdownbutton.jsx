
import { Link } from "react-router-dom";

const DropdownButton = ({ dropdownContents, children, dropdownPosition, toggle,setToggle}) => {
   
   
    return ( 
        
        <div className="relative">
            <button onClick={()=>{setToggle(!toggle)}} >
                {children}
            </button>
            {toggle && <button onClick={()=>{setToggle(false)}}  className="fixed inset-0 h-full w-full cursor-default"></button>}
            {toggle && <div className={" absolute z-10 w-48  origin-top-right bg-white border border-gray-100 rounded-md shadow-lg " + dropdownPosition}>
                 <ul className="p-2">
                    {dropdownContents.map((linkInfo, index) => (
                        <li key={index} >
                        <Link to={linkInfo.path} className="block px-4 py-2 font-semibold text-gray-500 rounded-lg hover:bg-primary/5 hover:text-gray-700" >{linkInfo.name} </Link>
                        </li>
                    ))}
                    
                 </ul>
             </div>}
        </div>
     );
}
 
export default DropdownButton;