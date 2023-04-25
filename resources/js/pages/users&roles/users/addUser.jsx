import FormButton from "../../../components/buttons/formButton";
import PageTitle from "../../../components/typography/pageTitle";
import PageContainer from "../../../layouts/pageContainer";
import PageInput, {
    PageSelectInput,
} from "../../../components/inputs/pageInput";

const AddUser = () => {
    const rolesOptions = [
        {
            name: "Admin",
            value: null,
        },
    ];

    return (
        <div className="">
            <PageContainer>
                <PageTitle title="New User" />
                <form>
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-8 w-full ">
                        <div className="space-y-4">
                            <PageInput
                                label="First Name"
                                type="text"
                                placeholder="First Name"
                                name="firstname"
                                id="firstname"
                                value=""
                                onchange={(event) => {}}
                            />
                            <PageInput
                                label="Last Name"
                                type="text"
                                placeholder="Last Name"
                                name="lastname"
                                id="lastname"
                                value=""
                                onchange={(event) => {}}
                            />
                            <PageInput
                                label="Username"
                                type="text"
                                placeholder="Username"
                                name="username"
                                id="username"
                                value=""
                                onchange={(event) => {}}
                            />
                            <PageInput
                                label="Phone"
                                type="phone"
                                placeholder="23350957412"
                                name="phone"
                                id="phone"
                                value=""
                                onchange={(event) => {}}
                            />
                            <PageInput
                                label="Email"
                                type="email"
                                placeholder="example@email.com"
                                name="email"
                                id="email"
                                value=""
                                onchange={(event) => {}}
                            />
                            <PageInput
                                label="Position"
                                type="text"
                                placeholder="Position / Job Title"
                                name="position"
                                id="position"
                                value=""
                                onchange={(event) => {}}
                            />
                            <PageSelectInput
                                label="Roles"
                                name="roles"
                                id="roles"
                                options={rolesOptions}
                                value=""
                                onchange={(event) => {}}
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
                                value=""
                                onchange={(event) => {}}
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
        </div>
    );
};

export default AddUser;
