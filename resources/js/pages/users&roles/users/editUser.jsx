import FormButton from "../../../components/buttons/formbutton";
import PageTitle from "../../../components/typography/pagetitle";
import ViewText, {ViewMutiText} from "../../../components/typography/viewtext";
import PageContainer from "../../../layouts/pageContainer";
import PageInput, {
    PageSelectInput,
    RadioInput
} from "../../../components/inputs/pageinput";

const EditUser = () => {
  const rolesOptions = [
    {
        name: "Admin",
        value: null,
    },
];
  return ( 

    <PageContainer>
                <PageTitle title="Edit User" />
                <form>
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-8 w-full ">
                        <div className="space-y-4">
                        <ViewText label="Username" name="username" data="Username" />
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
                            <div className="block space-y-1 py-2">
                                    <label
                                        htmlFor="status"
                                        className="font-medium"
                                    >
                                        Status
                                    </label>
                                    <div className="flex space-x-6">
                                        <RadioInput
                                            name="status"
                                            id="active"
                                            label="Active"
                                            value="1"
                                            checked={"1"}
                                            onchange={(event) => {}}
                                        />
                                        <RadioInput
                                            name="status"
                                            id="suspended"
                                            label="Suspended"
                                            value="2"
                                            checked={"2"}
                                            onchange={(event) => {}}
                                        />
                                       
                                    </div>
                                </div>
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
                           
                        </div>

                        <div className="space-y-4"></div>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-x-8 py-6 w-full ">
                        <div className=" w-ful  flex justify-end">
                            <FormButton cancelTo="/" />
                        </div>
                    </div>
                </form>
            </PageContainer>
   );
}
 
export default EditUser;