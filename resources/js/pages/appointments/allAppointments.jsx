import Table from "../../components/tables/table";
import PageTitle from "../../components/typography/pagetitle.jsx";
import PageContainer from "../../layouts/pageContainer.jsx";
import moment from 'moment';
import { getAuthUser } from "../../services/storage.jsx";
import { FaEye, FaEdit, FaTrash } from "react-icons/fa";
import { useEffect, useState } from "react";
import DeleteModal from "../../components/modals/delete.jsx";
import { Link } from "react-router-dom";
import { ToastContainer } from 'react-toastify';
import { successNotif, errorNotif } from "../../services/toast.jsx";

const getAppointments = async (searchDate) => {
  try {
    const response = await axios.get("appointments", { params: { date: searchDate } });

    return response?.data?.data;
  } catch (error) {
    console.log(error);
  }
}

const AllAppointments = () => {
  let today = moment(new Date()).format('YYYY-MM-DD')
  const [date, setDate] = useState(today)

  const [appointments, setAppointments] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const [user, setUser] = useState(null);
  const viewAppointment = "view-appointments";
  const editAppointment = "edit-appointments";
  const deleteAppointment = "delete-appointments";
  const [selectedAppointment, setSelectedAppointment] = useState(null);
  const [showDeleteModal, setShowDeleteModal] = useState(false);

  useEffect(() => {
    const authUser = getAuthUser();
    // This function should return the authenticated user if it exists

    setUser(authUser);
    setIsLoading(true);
    getAppointments(date).then((data) => {
      setAppointments(data);
      setIsLoading(false);
    });
  }, [date]);

  const handleDeleteClick = (client) => {
    setSelectedAppointment(client);
    setShowDeleteModal(true);
  };

  const confirmDelete = async () => {
    try {
      const response = await axios.delete(`clients/${selectedClient.id}`);
      successNotif("Client successfully deleted");

      //reload users
      setAppointments(appointments.filter((appointment) => appointment.id !== selectedAppointment.id));
      setSelectedAppointment(null);
      setShowDeleteModal(false);
      getAppointments(date); // reload the roles after delete
    } catch (error) {

      setShowDeleteModal(false);
      // setError(error);
      errorNotif(error.response.data.error);

    }
  };
  const canViewAppointment = () => {
    return user?.role?.permissions.some(
      (permission) =>
        permission.name === viewAppointment || permission.name === editAppointment
    );
  };

  const canEditAppointment = (row) => {
    return user?.role?.permissions.some(
      (permission) => permission.name === editAppointment
    );
  };

  const canDeleteAppointment = (row) => {
    return user?.role?.permissions.some(
      (permission) => permission.name === deleteAppointment
    ) && row.id !== user?.id;
  };

  const columns = [
    {
      name: 'Client Name',
      cell: (row) => { if (row?.client.othernames == null || row?.client.othernames == "undefined") { return `${row?.client.firstname} ${row?.client.lastname}` } else { return `${row?.client.lastname} ${row?.client.firstname} ${row.othernames}` } },

    },
    {
      name: 'Appointment Type',
      selector: row => row.appointment_type
    },
    {
      name: 'Time',
      selector: row => row.appointment_time,
    },
    {
      name: 'Status',
      selector: row => row.appointment_status
    },
    {
      name: "Actions",
      cell: (row) => (
        <div className="flex flex-wrap space-x-4">
          {(canViewAppointment() || canEditAppointment()) && (
            <Link
              to={`/clients/${row.id}/view`}
              className="text-primary cursor-pointer hover:text-primary-100"
            >

              <FaEye />
            </Link>
          )}

          {canEditAppointment() && (
            <FaEdit className="text-primary cursor-pointer hover:text-primary-100" />
          )}

          {canDeleteAppointment(row) && (
            <FaTrash
              className="text-primary cursor-pointer hover:text-primary-100"
              onClick={() => handleDeleteClick(row)}
            />
          )}
        </div>
      ),
    },
  ];

  if (isLoading) {
    return <div>Loading...</div>;
  }
  return (
    <div>
      <PageContainer>
        <PageTitle title="Appointments" />
        <div className="flex flex-wrap mb-6 justify-end">
          <input className="form-input" type="date" name="daye" id="date" value={date} onChange={(event) => { setDate(moment(event.target.value).format('YYYY-MM-DD')); }} />
        </div>
        <Table columns={columns} data={appointments} />
        <DeleteModal
          show={showDeleteModal}
          title="Delete Appointment"
          onClose={(event) => setShowDeleteModal(false)}
          onDelete={(event) => confirmDelete()}
          message="Are you sure you want to delete this appointment"
        // name={`${selectedClient?.firstname} ${selectedClient?.lastname} ${selectedClient?.lastname}`}
        />
      </PageContainer>
      <ToastContainer />
    </div>
  );
}

export default AllAppointments;