import PageTitle from "../../components/typography/pagetitle.jsx";
import ViewText from "../../components/typography/viewtext.jsx";
import PageContainer from "../../layouts/pageContainer";

const ViewAppointment = () => {
    return (
        <PageContainer>
            <PageTitle title="View Appointment" />

            <div className="grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-8 w-full ">
                <div className="space-y-4">
                    <ViewText
                        label="Client Name"
                        name="clientName"
                        data={`John Kuaw Doe`}
                    />
                    <ViewText
                        label="Client Number"
                        name="clientNumber"
                        data={`ABC10-232324`}
                    />
                    <ViewText label="Type" name="type" data={`Review`} />
                    <ViewText label="Date" name="date" data={`20 Jan 2023`} />
                    <ViewText label="Time" name="time" data={`13:45`} />
                    <ViewText
                        label="Note"
                        name="time"
                        data={`The patient is short sighted and has been  booked to come for a review later in the day`}
                    />
                </div>

                <div className="space-y-4"></div>

                <div className="space-y-4"></div>
            </div>
        </PageContainer>
    );
};

export default ViewAppointment;
