import PageTitle from "../../components/typography/pageTitle";
import ViewText from "../../components/typography/viewText";
import PageContainer from "../../layouts/pageContainer";
import { useParams,useNavigate } from 'react-router-dom';
import { useEffect,useState } from "react";
import moment from "moment";

const ViewClient = () => {

  const navigate = useNavigate();
  const {id} = useParams();
  const [client,setClient] = useState(null);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    const fetchClient = async () => {
      try {

        const response = await axios.get(`clients/${id}`);

        let data = response?.data?.data;

        setClient(data);

        setIsLoading(false);

      }catch{
        console.log(error.response.status);
        if(error.response.status == 500){
          navigate("/clients", { replace: true });
        }
      }
    };

    fetchClient();

  },[id,navigate]);

  if (isLoading) {
    return <div>Loading...</div>;
  }

  return ( 
    <PageContainer >
      <PageTitle title={`View Client - ${client.firstname} ${client.lastname}`} />
      <div className="grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-8 w-full ">
      <div className="space-y-4">
      <ViewText label="Title" name="title" data={client.title ? client.title : 'N/A'} />
      <ViewText label="First Name" name="firstname" data={client.firstname ? client.firstname : 'N/A'} />
      <ViewText label="Last Name" name="lastname" data={`Aban`} />
      <ViewText label="Other Name" name="othername" data={client.othernames ? client.othernames : 'N/A'} />
      <ViewText label="Date Of Birth" name="dateofbirth" data={client? moment(client.date_of_birth).format('DD MMM YYYY'):'N/A'} />
      <ViewText label="Sex" name="sex" data={client.sex === 'M' ? 'Male' : client.sex === 'F' ? 'Female' : 'N/A'} />
      <ViewText label="Email" name="email" data={client.email ? client.email : 'N/A'} />

      </div>
      <div className="space-y-4">
      <ViewText label="Address" name="firstaddressline"
      
      data={`${client.residence.first_address_line}${client.residence.second_address_line ? ', ' + client.residence.second_address_line : ''}${client.residence.third_address_line ? ', ' + client.residence.third_address_line : ''}, ${client.residence.town}, ${client.residence.county}, ${client.residence.postcode}`} 
      />


<ViewText label="Emergency Contact Name" name="emergencycontactname" data={client.emergency_contact.emergency_contact_name ? client.emergency_contact.emergency_contact_name : 'N/A'} />
      <ViewText label="Emergency Contact Phone" name="" data={client.emergency_contact.emergency_contact_phone ? client.emergency_contact.emergency_contact_phone : 'N/A'} />
      </div>
      
      </div>
    </PageContainer>
   );
}
<ViewText label="" name="" data={``} />
export default ViewClient;
<>

</>