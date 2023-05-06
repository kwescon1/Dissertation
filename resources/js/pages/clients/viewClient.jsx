import PageTitle from "../../components/typography/pageTitle";
import ViewText from "../../components/typography/viewText";
import PageContainer from "../../layouts/pageContainer";

const ViewClient = () => {
  return ( 
    <PageContainer >
      <PageTitle title={`View Client - [Clinet Name]`} />
      <div className="grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-8 w-full ">
      <div className="space-y-4">
      <ViewText label="Title" name="title" data={`Mr.`} />
      <ViewText label="First Name" name="firstname" data={`John`} />
      <ViewText label="Last Name" name="lastname" data={`Aban`} />
      <ViewText label="Other Name" name="othername" data={`Kwame`} />
      <ViewText label="Date Of Birth" name="dateofbirth" data={`02 May 2023`} />
      <ViewText label="Sex" name="sex" data={`M`} />
      <ViewText label="Email" name="email" data={`johnaban@email.com`} />

      </div>
      <div className="space-y-4">
      <ViewText label="First Address Line" name="firstaddressline" data={`Accra`} />
      <ViewText label="Second Address Line" name="secondaddressline" data={`Accra`} />
      <ViewText label="Third Address Line" name="thirdaddressline" data={`Accra`} />
      <ViewText label="Town" name="town" data={`Accra`} />
      <ViewText label="County" name="county" data={`Accra`} />
      <ViewText label="Postcode" name="postcode" data={`233`} />
      </div>
      <div className="space-y-4">
      <ViewText label="Emergency Contact Name" name="emergencycontactname" data={`Jame Aban`} />
      <ViewText label="Emergency Contact Phone" name="" data={`233801457582`} />
      </div>
      </div>
    </PageContainer>
   );
}
<ViewText label="" name="" data={``} />
export default ViewClient;
<>

</>