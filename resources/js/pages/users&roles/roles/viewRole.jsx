import PageTitle from "../../../components/typography/pagetitle";
import ViewText, {ViewMutiText} from "../../../components/typography/viewtext";
import PageContainer from "../../../layouts/pagecontaner";

const ViewRole = () => {
  const userPermissions = [
    {
      name: "edit-user"
    },
    {
      name: "view-user"
    },
  ]
  const rolePermissions = [
    {
      name: "edit-role"
    },
    {
      name: "view-role"
    },
  ]
  const clientPermissions = [
    {
      name: "edit-client"
    },
    {
      name: "view-client"
    },
  ]
  const users = [
    {
      name: "John Doe"
    },
    {
      name: "Jane Doe"
    },
    {
      name: "Juan Frey"
    },
    {
      name: "Max Aban"
    },
    {
      name: "Aba Sway"
    },
  ]
  return ( 
    <div>
      <PageContainer >
      <PageTitle title="View Role - [Role Name]" />
      <div className="grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-8 w-full ">
      <div className="space-y-4">
        <ViewText label="Role Name" name="rolename" data="Administrator" />
        <ViewText label="Description" name="description" data="Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam. Nam tristique tortor eu pede." />
        <ViewText label="Created" name="created" data="12 Dec 2023 " />
        <ViewText label="Last Updated" name="lastupdated" data="12 Dec 2023" />
      </div>
      <div className="space-y-2">
      <div className="font-semibold ">Permissions</div>
      <ViewMutiText label="Users" dataInfo={userPermissions}/>
      <ViewMutiText label="Roles" dataInfo={rolePermissions}/>
      <ViewMutiText label="Client" dataInfo={clientPermissions}/>
      </div>
      <div className="">
      <ViewMutiText label="Users(5)" dataInfo={users}/>
      </div>
      </div>
      </PageContainer>
    </div>
   );
}
 
export default ViewRole;