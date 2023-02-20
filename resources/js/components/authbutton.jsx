import { Link } from "react-router-dom";

const AuthButton = ({ btnText, linkText, linkTo }) => {
    return ( 
        <div className="space-y-3">
            <div>
            <button className="py-2 w-full rounded bg-primary  font-semibold text-center text-white hover:bg-blue-500" type="submit">{btnText}</button>
            </div>
            <div>
            <Link className="text-secondary hover:underline "  to={linkTo}>{linkText}</Link>
            </div>
        </div>
     );
}
 
export default AuthButton;