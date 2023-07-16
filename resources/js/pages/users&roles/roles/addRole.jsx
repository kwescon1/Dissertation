import FormButton from "../../../components/buttons/formButton";
import PageInput, {
    TextAreaInput,
    CheckboxInput,
} from "../../../components/inputs/pageInput";
import PageTitle from "../../../components/typography/pageTitle";
import PageContainer from "../../../layouts/pageContainer";

const AddRole = () => {
    return (
        <PageContainer>
            <PageTitle title="New User" />
            <form>
                <div className="grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-8 w-full ">
                    <div className="space-y-4">
                        <PageInput
                            label="Role"
                            type="text"
                            placeholder="Role"
                            name="role"
                            id="role"
                            value=""
                            onchange={(event) => {}}
                        />
                        <TextAreaInput
                            label="Role Description"
                            placeholder="Role Description"
                            name="roledescription"
                            id="roledescription"
                            value=""
                            onchange={(event) => {}}
                        />
                    </div>

                    <div className="space-y-4">
                        <div className="block space-y-1">
                            <label
                                htmlFor="permisions"
                                className="font-semibold "
                            >
                                Permissions
                            </label>
                            <ul className="">
                        {/* {permissions.map((permission, index) => (
                            <li key={index}> */}
                               <CheckboxInput
                                name="permission"
                                id="permission"
                                label="edit-client"
                                value="1"
                                checked={""}
                                onchange={(event) => {}}
                            /> 
                            {/* </li>
                        ))} */}
                    </ul>
                           
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
    );
};

export default AddRole;
