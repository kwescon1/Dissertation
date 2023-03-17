import { useEffect, useState } from "react";
import FormButton from "../../components/buttons/formbutton";
import PageInput, {
    PageSelectInput,
    RadioInput,
} from "../../components/inputs/pageinput";
import Logo from "../../components/logo/NavBarLogo";
import PageTitle from "../../components/typography/pagetitle";
import PageContainer from "../../layouts/pagecontaner";
import { Form } from "react-router-dom";

function AddClient(){
    const [isLoading,setIsLoading] = useState(true);
    const [isInvalidLink, setIsInvalidLink] = useState(false);
    const [errorMessage, setErrorMessage] = useState(""); // i doubt id use this
    const [formData, setFormData] = useState({
        title:"",
        firstname: "",
        lastname:"",
        othertnames:"",
        date_of_birth:"",
sex:"",
email:"",
first_address_line:"",
second_address_line:"",
third_address_line:"",
town:"",
county:"",
postcode:"",
emergency_contact_name:"",
emergency_contact_phone:"",
facility_id:"",
facility_branch_id:"",
phone:"",

    });

    const handleInputChange = event => {
        setFormData({
          ...formData,
          [event.target.name]: event.target.value
        });
      };

      const handleSubmit = event => {
        event.preventDefault();

        console.log(formData);
        // axios.post("clients", formData)
        //   .then(response => {
        //     console.log(response.data);
        //     // redirect to success page or display success message
        //   })
        //   .catch(error => {
        //     setErrorMessage("Oops. something went wrong");
        //   });
      };

    useEffect(() => {

        async function verifyLink(){
            var url = window.location.href
            var appRoute = process.env.MIX_APP_URL;
            var apiCallRoute = url.replace(appRoute, "");

            try {
                const response = await axios.get(apiCallRoute);

                const { facility_id, facility_branch_id, phone } = response?.data;

                console.log(response,response?.data)
                
                setFormData({...formData,facility_id,facility_branch_id,phone,});

                setIsLoading(false);

            } catch (error) {
                setIsInvalidLink(true);
          setIsLoading(false);
            }
        }

        verifyLink();

    },[]);

    if (isLoading) {
        return <div>Loading...</div>;
        }

    if (isInvalidLink) {
        return <div>Oops. the link is invalid</div>;
    }

    const titleOptions = [
        {
            name: "Mr",
            value: null,
        },
        {
            name: "Mrs",
            value: null,
        },
        {
            name: "Miss",
            value: null,
        },
        {
            name: "Other",
            value: null,
        },
    ];

         return (
            <div>
                <nav className="fixed top-0 left-0 right-0">
                    <div className="w-full h-16  bg-primary-5 border-b border-primary-25">
                        <div className="mx-4 h-full flex items-center justify-between ">
                            <div className="w-full flex items-center space-x-10">
                                <Logo />
                            </div>
                        </div>
                    </div>
                </nav>
                <div className="mt-16">
                    <PageContainer>
                        <PageTitle title="New Client" />
                        <Form onSubmit={handleSubmit}>
                            <div className="grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-8 w-full ">
                                <div className="space-y-4">
                                    <PageSelectInput
                                        label="Title"
                                        name="title"
                                        id="title"
                                        options={titleOptions}
                                        value={formData.title}
                                        onChange={handleInputChange}
                                    />
                                    <PageInput
                                        label="First Name"
                                        type="text"
                                        placeholder="First Name"
                                        name="firstname"
                                        id="firstname"
                                    />
                                    <PageInput
                                        label="Last Name"
                                        type="text"
                                        placeholder="Last Name"
                                        name="lastname"
                                        id="lastname"
                                        value={formData.firstname}
                                    />
                                    <PageInput
                                        label="Other Names"
                                        type="text"
                                        placeholder="Other Name"
                                        name="othertnames"
                                        id="othertnames"
                                    />
                                    <div className="block space-y-1 py-2">
                                        <label
                                            htmlFor="dob"
                                            className="font-medium"
                                        >
                                            Date of Birth
                                        </label>
    
                                        <PageInput
                                            label=""
                                            type="date"
                                            placeholder=""
                                            name="date_of_birth"
                                            id="dateofBirth"
                                            value={formData.date_of_birth}
                                            onChange={handleInputChange}
                                        />
                                    </div>
                                    <div className="block space-y-1 py-2">
                                        <label
                                            htmlFor="sex"
                                            className="font-medium"
                                        >
                                            Sex
                                        </label>
                                        <div className="flex space-x-6">
                                            <RadioInput
                                                name="sex"
                                                id="male"
                                                label="Male"
                                                value="M"
                                            />
                                            <RadioInput
                                                name="sex"
                                                id="female"
                                                label="Female"
                                                value="F"
                                            />
                                            <RadioInput
                                                name="sex"
                                                id="other"
                                                label="Other"
                                                value="O"
                                            onChange={handleInputChange}
                                            />
                                        </div>
                                    </div>
                                    <PageInput
                                        label="Phone"
                                        type="phone"
                                        placeholder="+233247635185"
                                        name="phone"
                                        id="phone"
                                        readOnly
                                        value={formData.phone}
                                            onChange={handleInputChange}
                                    />
                                    <PageInput
                                        label="Email"
                                        type="email"
                                        placeholder="example@email.com"
                                        name="email"
                                        id="email"
                                        value={formData.email}
                                            onChange={handleInputChange}
                                    />
                                </div>
    
                                <div className="space-y-4">
                                    <div>
                                        <label
                                            htmlFor="residentialDetails"
                                            className="font-medium "
                                        >
                                            Residential Details
                                        </label>
                                        <div className="space-y-4 mt-1">
                                            {/* <div className="block grid grid-cols-4">
                                                <input
                                                    className="col-span-3 form-input rounded-l border-gray-400 w-full"
                                                    type="text"
                                                    placeholder="Enter your postcode"
                                                    name="search"
                                                    id="search"
                                                />
                                                <button
                                                    className="bg-secondary rounded-r text-white font-semibold hover:bg-secondary-100 "
                                                    type="button"
                                                    name="searchbtn"
                                                    id="searchbtn"
                                                >
                                                    Search
                                                </button>
                                            </div> */}
                                            <PageInput
                                                label="First Address Line"
                                                type="text"
                                                placeholder="First Address Line"
                                                name="first_address_line"
                                                id="first_address_line"
                                                value={formData.first_address_line}
                                            onChange={handleInputChange}
                                            />
                                            <PageInput
                                                label="Second Address Line"
                                                type="text"
                                                placeholder="Second Address Line"
                                                name="second_address_line"
                                                id="second_address_line"
                                                value={formData.second_address_line}
                                            onChange={handleInputChange}
                                            />
                                            <PageInput
                                                label="Third Address Line"
                                                type="text"
                                                placeholder="Third Address Line"
                                                name="third_address_line"
                                                id="third_address_line"
                                                value={formData.third_address_line}
                                            onChange={handleInputChange}
                                            />
                                            <PageInput
                                                label="Town"
                                                type="text"
                                                placeholder="Town"
                                                name="town"
                                                id="town"
                                                value={formData.town}
                                            onChange={handleInputChange}
                                            />
                                            <PageInput
                                                label="County"
                                                type="text"
                                                placeholder="County"
                                                name="county"
                                                id="county"
                                                value={formData.county}
                                            onChange={handleInputChange}
                                            />
                                            <PageInput
                                                label="Postcode"
                                                type="text"
                                                placeholder="Postcode"
                                                name="postcode"
                                                id="postcode"
                                                value={formData.postcode}
                                            onChange={handleInputChange}
                                            />
                                        </div>
                                    </div>
                                </div>
    
                                <div className="space-y-4">
                                    <PageInput
                                        label="Emergency Contact Name"
                                        type="text"
                                        placeholder="Emergency Contact Name"
                                        name="emergency_contact_name"
                                        id="emergency_contact_name"
                                        value={formData.emergency_contact_name}
                                            onChange={handleInputChange}
                                    />
                                    <PageInput
                                        label="Emergency Contact Phone"
                                        type="text"
                                        placeholder="Emergency Contact Phone(+233....)"
                                        name="emergency_contact_phone"
                                        id="emergency_contact_phone"
                                        value={formData.emergency_contact_phone}
                                            onChange={handleInputChange}
                                    />
                                </div>
                            </div>
    
                            <div className="w-ful py-6 flex justify-end">
                                <FormButton cancelTo="/" />
                            </div>
                        </Form>
                    </PageContainer>
                </div>
            </div>
        );
};

export default AddClient;
