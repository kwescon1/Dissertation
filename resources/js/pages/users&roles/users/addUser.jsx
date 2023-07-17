import FormButton from "../../../components/buttons/formbutton";
import PageTitle from "../../../components/typography/pagetitle";
import PageContainer from "../../../layouts/pageContainer";
import PageInput, {
    PageSelectInput,
} from "../../../components/inputs/pageinput";
import { getAuthUser } from "../../../services/storage";
import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import { ToastContainer } from 'react-toastify';
import { successNotif,errorNotif } from "../../../services/toast";

const getRoles = async () => {
    try {
        const response = await axios.get("roles");

        return response?.data?.data;
    } catch (error) {
        console.log(error);
    }
};


const AddUser = () => {

    const navigate = useNavigate();
    const [user,setUser] = useState(null);
    const [isLoading, setIsLoading] = useState(true);
    const [authUser, setAuthUser] = useState(null);
    const [roles, setRoles] = useState([]);
    const [otp,setOtp] = useState('');

    const [formData,setFormData] = useState({
        facility_id: "",
        facility_branch_id: "",
        firstname: "",
        lastname: "",
        phone: "",
        email: "",
        username: "",
        password: "",
        position: "",
        role: "",
    });

    const handleInputChange = (event) => {
        setFormData({
            ...formData,
            [event.target.name]: event.target.value,
        });
    };

    const generateOTP =  () =>{

        let otp = Math.random().toString(16).substr(2, 6);
    
        setOtp(otp);
    }

    const handleSubmit = (event) => {
        event.preventDefault();

        console.log(formData);

        axios
            .post("users", formData)
            .then((response) => {
                successNotif("User created successfully");

                navigate("/users",{replace:true});

            })
            .catch((error) => {
                errorNotif(error.response.data.error)
                // console.log(error.response.data.error);
            });
    };

    useEffect(() => {
        const user = getAuthUser(); // This function should return the authenticated user if it exists

        setAuthUser(user);

        getRoles().then((data) => {
            const modifiedRoles = data.map((role) => ({
                name: role.name,
                value: role.id,
              }));

            setRoles(modifiedRoles);
            setIsLoading(false);
        });
      
        //set facility_id and facility_branch_id on formData
        formData.facility_id = user.facility_id;
        formData.facility_branch_id = user.facility_branch_id;
        formData.password = otp;
    }, []);


    if (isLoading) {
        return <div>Loading...</div>;
    }

    return (
        <div className="">
            <PageContainer>
                <PageTitle title="New User" />
                <form onSubmit={handleSubmit}>
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-8 w-full ">
                        <div className="space-y-4">
                            <PageInput
                                label="First Name"
                                type="text"
                                placeholder="First Name"
                                name="firstname"
                                id="firstname"
                                value={formData.firstname}
                                    onchange={(event) => {
                                        setFormData({
                                            ...formData,
                                            firstname: event.target.value,
                                        });
                                    }}
                            />
                            <PageInput
                                label="Last Name"
                                type="text"
                                placeholder="Last Name"
                                name="lastname"
                                id="lastname"
                                value={formData.lastname}
                                    onchange={(event) => {
                                        setFormData({
                                            ...formData,
                                            lastname: event.target.value,
                                        });
                                    }}
                            />
                            <PageInput
                                label="Username"
                                type="text"
                                placeholder="Username"
                                name="username"
                                id="username"
                                value={formData.username}
                                    onchange={(event) => {
                                        setFormData({
                                            ...formData,
                                            username: event.target.value,
                                        });
                                    }}
                            />
                            <PageInput
                                label="Phone"
                                type="phone"
                                placeholder="23350957412"
                                name="phone"
                                id="phone"
                                value={formData.phone}
                                    onchange={(event) => {
                                        setFormData({
                                            ...formData,
                                            phone: event.target.value,
                                        });
                                    }}
                            />
                            <PageInput
                                label="Email"
                                type="email"
                                placeholder="example@email.com"
                                name="email"
                                id="email"
                                value={formData.email}
                                    onchange={(event) => {
                                        setFormData({
                                            ...formData,
                                            email: event.target.value,
                                        });
                                    }}
                            />
                            <PageInput
                                label="Position"
                                type="text"
                                placeholder="Position / Job Title"
                                name="position"
                                id="position"
                                value={formData.position}
                                    onchange={(event) => {
                                        setFormData({
                                            ...formData,
                                            position: event.target.value,
                                        });
                                    }}
                            />
                            <PageSelectInput
                                label="Roles"
                                name="roles"
                                id="roles"
                                options={roles}
                                value={formData.role}
                                    onchange={(event) => {
                                        setFormData({
                                            ...formData,
                                            role: event.target.value,
                                        });
                                    }}
                            />
                        </div>

                        <div className="space-y-4">
                            <div className="border border-gray-400 rounded p-5 space-y-4">
                                <div className="border-2 border-black rounded p-3 text-sm font-medium">
                                    <span className="">
                                        Generate and share the One Time Password
                                        (OTP) with new users to grant them
                                        access.
                                    </span>
                                </div>
                                <PageInput
                                label="One Time Password"
                                type="text"
                                placeholder="abcd123"
                                name="onetimepassword"
                                id="onetimepassword"
                                value={formData.password}
                                    onchange={(event) => {
                                        setFormData({
                                            ...formData,
                                            password: event.target.value,
                                        });
                                    }}
                                onclick={() => {
                                    generateOTP();
                                }}
                            />
                            <div className="block">
                      <button className="py-2 w-full rounded bg-secondary  font-semibold text-center text-white hover:bg-secondary-100">Generate OTP</button>
                    </div>
                            </div>
                        </div>

                        <div className="space-y-4"></div>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-x-8 py-6 w-full ">
                        <div className="col-start-2 w-ful  flex justify-end">
                            <FormButton cancelTo="/" />
                        </div>
                    </div>
                </form>
            </PageContainer>
            <ToastContainer/>
        </div>
    );
};

export default AddUser;
