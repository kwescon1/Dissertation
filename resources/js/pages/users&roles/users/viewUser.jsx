import PageTitle from "../../../components/typography/pageTitle";
import ViewText from "../../../components/typography/viewText";
import PageContainer from "../../../layouts/pageContainer";
import { useParams,useNavigate } from 'react-router-dom';
import { useEffect,useState } from "react";
import moment from "moment";
import { Link } from "react-router-dom";

const ViewUser = () => {

  const navigate = useNavigate();
  const {id} = useParams();
  const [user,setUser] = useState(null);
  const [isLoading, setIsLoading] = useState(true);

  const STATUS_PENDING = 0; // default on add new user
  const STATUS_ACTIVE = 1;
  const STATUS_SUSPENDED = 2;

  useEffect(() => {
    const fetchUser = async () => {
      try {
        
        const response = await axios.get(`users/${id}`);

        let data = response?.data?.data;

        setUser(data);

        setIsLoading(false);
       
      } catch (error) {
        console.log(error.response.status);
        if(error.response.status == 500){
          navigate("/users", { replace: true });
        }
      }
    };
    fetchUser();

  },[id,navigate]);

  if (isLoading) {
    return <div>Loading...</div>;
  }

  return ( 
    <PageContainer >
      <PageTitle title="View User"/>
      <div className="grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-8 w-full ">
      <div className="space-y-4">
      <ViewText label="First Name" name="firstname" data={`${user? user.firstname: 'N/A'}`} />
      <ViewText label="Last Name" name="lastname" data={`${user? user.lastname: 'N/A'}`} />
      <ViewText label="Username" name="username" data={`${user? user.username: 'N/A'}`} />
      <ViewText label="Phone" name="phone" data={`${user? user.phone: 'N/A'}`} />
      <ViewText label="Email" name="email" data={`${user? user.email: 'N/A'}`} />
      <ViewText label="Status" name="status" data={`${user ? (user.status === STATUS_ACTIVE ? 'Active' : user.status === STATUS_SUSPENDED ? 'Suspended' : user.status === STATUS_PENDING ? 'Pending' : 'N/A') : 'N/A'}`} />

      <ViewText label="Position" name="position" data={`${user? user.position: 'N/A'}`} />

      <ViewText
  label="Role"
  name="role"
  data={
    user && user.role
      ? Array.isArray(user.role)
        ? "-"
        : <Link to={`/roles/${user.role.id}/view`}>{user.role.name}</Link>
      : "-"
  }
/>

      </div>
      <div className="space-y-4">
      <ViewText label="Added" name="added" data={`${user? moment(user.created_at).format('DD MMM YYYY'):''}`} />
      <ViewText label="Last Updated" name="lastupdated" data={`${user? moment(user.updated_at).format('DD MMM YYYY'):''}`} />
      
      <ViewText label="Last Login" name="lastlogin" data={`${user && user.last_login ? moment(user.last_login).format('DD MMM YYYY') : '-'}`} />
      </div>
      <div className="space-y-4"></div>
      </div>
    </PageContainer>
   );
}
 
export default ViewUser;