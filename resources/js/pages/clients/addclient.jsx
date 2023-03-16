import { useEffect, useState } from "react";
import { Form, useNavigate } from "react-router-dom";
import FormButton from "../../components/buttons/formbutton";
import PageInput, {
    PageSelectInput,
    RadioInput,
} from "../../components/inputs/pageinput";
import Logo from "../../components/logo/NavBarLogo";
import PageTitle from "../../components/typography/pagetitle";
import PageContainer from "../../layouts/pagecontaner";

const AddClient = () => {
    useEffect(async () => {
        let url = window.location.href;

        let apiRoute = process.env.MIX_BASE_URL;
        let appRoute = process.env.MIX_APP_URL;

        console.log(process.env.MIX_BASE_URL);
        console.log(process.env.MIX_APP_URL);

        // var apiCallRoute = url.replace(appRoute, apiRoute);
        var apiCallRoute = url.replace(appRoute, "");
        // console.log(apiCallRoute);
        // console.log(apiRoute,appRoute,apiCallRoute);

           try {
            let response = await axios.get(apiCallRoute);

            console.log(response);
           } catch (error) {
            
            console.log(error);
           }
    });

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
                    <Form>
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-8 w-full ">
                            <div className="space-y-4">
                                <PageSelectInput
                                    label="Title"
                                    name="title"
                                    id="title"
                                    options={titleOptions}
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
                                />
                                <PageInput
                                    label="Other Name"
                                    type="text"
                                    placeholder="Other Name"
                                    name="othertname"
                                    id="othertname"
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
                                        name="dateofBirth"
                                        id="dateofBirth"
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
                                            value=""
                                        />
                                        <RadioInput
                                            name="sex"
                                            id="female"
                                            label="Female"
                                            value=""
                                        />
                                        <RadioInput
                                            name="sex"
                                            id="other"
                                            label="Other"
                                            value=""
                                        />
                                    </div>
                                </div>
                                <PageInput
                                    label="Phone"
                                    type="phone"
                                    placeholder="0553214563"
                                    name="phone"
                                    id="phone"
                                />
                                <PageInput
                                    label="Email"
                                    type="email"
                                    placeholder="example@email.com"
                                    name="email"
                                    id="email"
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
                                        <div className="block grid grid-cols-4">
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
                                        </div>
                                        <PageInput
                                            label="First Address Line"
                                            type="text"
                                            placeholder="First Address Line"
                                            name="firstAddressLine"
                                            id="firstAddressLine"
                                        />
                                        <PageInput
                                            label="Second Address Line"
                                            type="text"
                                            placeholder="Second Address Line"
                                            name="secondAddressLine"
                                            id=""
                                        />
                                        <PageInput
                                            label="Third Address Line"
                                            type="text"
                                            placeholder="Third Address Line"
                                            name="thirdAddressLine"
                                            id="thirdAddressLine"
                                        />
                                        <PageInput
                                            label="Town"
                                            type="text"
                                            placeholder="Town"
                                            name="town"
                                            id="town"
                                        />
                                        <PageInput
                                            label="County"
                                            type="text"
                                            placeholder="County"
                                            name="county"
                                            id="county"
                                        />
                                        <PageInput
                                            label="Postcode"
                                            type="text"
                                            placeholder="Postcode"
                                            name="postcode"
                                            id="postcode"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div className="space-y-4">
                                <PageInput
                                    label="Emergency Contact Name"
                                    type="text"
                                    placeholder="Emergency Contact Name"
                                    name="emergencyContactName"
                                    id="emergencyContactName"
                                />
                                <PageInput
                                    label="Emergency Contact Phone"
                                    type="text"
                                    placeholder="Emergency Contact Phone"
                                    name="emergencyContactPhone"
                                    id="emergencyContactPhone"
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
