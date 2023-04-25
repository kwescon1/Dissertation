import PageTitle from "../../../components/typography/pageTitle";
import ViewText from "../../../components/typography/viewText";
import PageContainer from "../../../layouts/pageContainer";

const ViewUser = () => {
  return ( 
    <PageContainer >
      <PageTitle title="View User"/>
      <div className="grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-8 w-full ">
      <div className="space-y-4">
      <ViewText label="first Name" name="firstname" data={`Kwame`} />
      <ViewText label="Last Name" name="lastname" data={`Nkrumah`} />
      <ViewText label="Username" name="username" data={`KwameNkrumah`} />
      <ViewText label="Phone" name="phone" data={`23350785126`} />
      <ViewText label="Email" name="email" data={`kwame.nkrumag@mail.com`} />
      <ViewText label="status" name="status" data={`Active`} />
      <ViewText label="Position" name="position" data={`Doctor`} />
      <ViewText label="Role" name="role" data={`Administrator`} />
      </div>
      <div className="space-y-4">
      <ViewText label="Added" name="added" data={`23 Jan 2023`} />
      <ViewText label="Last Updated" name="lastupdated" data={`23 Jan 2023`} />
      <ViewText label="Last Login" name="lastlogin" data={`23 Jan 2023`} />
      </div>
      <div className="space-y-4"></div>
      </div>
    </PageContainer>
   );
}
 
export default ViewUser;