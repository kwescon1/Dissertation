import PageTitle from "../../../components/typography/pagetitle";
import ViewText, {ViewMutiText} from "../../../components/typography/viewtext";
import PageContainer from "../../../layouts/pagecontaner";
import { useParams,useNavigate } from 'react-router-dom';
import { useEffect,useState } from "react";
import moment from "moment";

const ViewRole = () => {
  const navigate = useNavigate();
  const {id} = useParams();
  const [role,setRole] = useState(null);
  const [isLoading, setIsLoading] = useState(true);

  const users = role?.users?.map(user => {
    return {
      id: `${user?.id}`,
      name: `${user.firstname} ${user.lastname}`,
    };
  });

  const permissions = role?.permissions?.map(permission  => {
    return {
      name: `${permission.label}`,
    };
  });

  useEffect(() => {
    const fetchRole = async () => {
      try {
        
        const response = await axios.get(`roles/${id}`);

        let data = response?.data?.data;

        setRole(data);

        setIsLoading(false);
       
      } catch (error) {
        console.log(error.response.status);
        if(error.response.status == 500){
          navigate("/roles", { replace: true });
        }
      }
    };
    fetchRole();
  },[id,navigate]);
 

  if (isLoading) {
    return <div>Loading...</div>;
  }

  return ( 
    <div>
      <PageContainer >
      <PageTitle title={`View Role - [${role ? role.name : ''}]`} />
      <div className="grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-8 w-full ">
      <div className="space-y-4">
        <ViewText label="Role Name" name="rolename" data={`${role? role.name:''}`} />
        <ViewText label="Description" name="description" data={`${role? role.description:'' }`} />
        <ViewText label="Created" name="created" data={`${role? moment(role.created_at).format('DD MMM YYYY'):''}`} />
        <ViewText label="Last Updated" name="lastupdated" data={`${role? moment(role.updated_at).format('DD MMM YYYY'):''}`} />
      </div>
      <div className="space-y-2">
      <ViewMutiText label={`Permissions (${permissions.length})`} dataInfo={permissions}/>
      </div>
      <div className="">
      <ViewMutiText label={`Users (${users.length})`} dataInfo={users}/>
      </div>
      </div>
      </PageContainer>
    </div>
   );
}
 
export default ViewRole;