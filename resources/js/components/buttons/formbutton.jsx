import { Link } from "react-router-dom";

const FormButton = ({cancelTo}) => {
  return ( 
    <div className="flex space-x-4 ">
        <button type="submit" className="py-2 px-4 bg-primary text-white font-semibold rounded hover:bg-primary-100">Save</button>
        <Link className="py-2 px-4 bg-secondary-10 text-gray-500 font-semibold rounded  hover:bg-secondary-20 hover:text-gray-600" to={cancelTo}>Cancel</Link>
    </div>
   );
}
 
export default FormButton;