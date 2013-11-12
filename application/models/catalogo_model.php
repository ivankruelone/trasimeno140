<?php
	class Catalogo_model extends CI_Model {

    function productos()
    {
        $sql = "SELECT * FROM catalogo.cat_nuevo_general_cla  order by clagob";
        $query = $this->db->query($sql);
        
        
        
        
        $tabla= "
        <table id=\"hor-minimalist-b\">
        <thead>
        <tr>
        
        </tr>
        <tr>
        <th align=\"left\">Sec</th>
        <th align=\"left\">Clave</th>
        <th align=\"left\"></th>
        <th align=\"left\">Sustancia Activa</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        foreach($query->result() as $row)
        {
            //$l1 = anchor('catalogo/cambiar_accesorio/'.$row->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para modificar productos!', 'class' => 'encabezado'));
            $tabla.="
            <tr>
            <td align=\"left\">".$row->sec."</td>
            <td align=\"left\"><font color=\"blue\">".$row->clagob."</td>
            <td align=\"center\">_</td>
            <td align=\"left\">".$row->susa."</td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
        
    }
/////////////////////////////////////////////////////////////////    
/////////////////////////////////////////////////////////////////
function trae_datos($clave){
    $sql = "SELECT *  FROM catalogo.cat_nuevo_general where clagob= ? ";
    $query = $this->db->query($sql,array($clave));
     return $query;
    }
/////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////// 
   function busca_sucursal()
	{
		$sql = "SELECT suc,nombre FROM  catalogo.sucursal where  
         suc in(187,176,177,178,179,180,9900,14000,16000,17000,6050,90002,900) order by nombre";
        $query = $this->db->query($sql);
        
        $suc = array();
        $suc[0] = "Selecciona una Sucursal";
        
        foreach($query->result() as $row){
            $suc[$row->suc] = $row->nombre." - ".$row->suc;
        }
        
        
        return $suc;
	} 
/////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////// 
   function busca_sucursal_dev()
	{
		$sql = "SELECT suc,nombre FROM  catalogo.sucursal where  
         suc in(187,176,177,178,179,180,9900,14000,16000,17000,6050,90002,900)
        order by nombre";
        
        $query = $this->db->query($sql);
        
        $suc = array();
        $suc[0] = "Selecciona una Sucursal";
        
        foreach($query->result() as $row){
            $suc[$row->suc] = $row->nombre." - ".$row->suc;
        }
        
        
        return $suc;
	}   
/////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////// 
   function busca_prv_prv()
	{
		$sql = "SELECT * FROM  catalogo.provedor where  
         tipo='A'
        order by razo";
        
        $query = $this->db->query($sql);
        
        $prv = array();
        $prv[0] = "Selecciona una Provedor";
        
        foreach($query->result() as $row){
            $prv[$row->prov] = $row->razo." - ".$row->prov;
        }
        
        
        return $prv;
	}
    /////////////////////////////////////////////////////////////

 function busca_prv_unico($prov)
    {
      $sql = "SELECT  razo FROM  catalogo.provedor where prov = ?";
    $query = $this->db->query($sql,array($prov));
    $row= $query->row();
    $$provx=$row->razo;
     return $provx; 
    }   
/////////////////////////////////////////////////////////////

 function busca_suc_unica($suc)
    {
      $sql = "SELECT  nombre FROM  catalogo.sucursal where suc = ?";
    $query = $this->db->query($sql,array($suc));
    $row= $query->row();
    $sucx=$row->nombre;
     return $sucx; 
    }

///////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////// 
   function busca_almacen()
	{
		$sql = "SELECT *from catalogo.cat_almacenes";
        $query = $this->db->query($sql);
        
        $alm = array();
        $alm[0] = "Selecciona un Almacen";
        
        foreach($query->result() as $row){
            $alm[$row->tipo] = $row->nombre;
        }
        
        
        return $alm;
	} 
  /////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////// 
   function busca_prv()
	{
		$sql = "SELECT *from catalogo.cat_nuevo_general_prv a left join catalogo.provedor b on b.prov=a.prv
        group by prv";
        $query = $this->db->query($sql);
        
        $var = array();
        $var[0] = "Selecciona un Proveedor";
        
        foreach($query->result() as $row){
            $var[$row->prov] = $row->razo;
        }
        
        
        return $var;
	} 
/////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////// 
   function busca_orden($id)
	{
		$sql = "SELECT a.*,b.*,c.razon as razof, c.dire as diref, c.pobla as poblaf, c.col as colf,c.cp as cpf, c.rfc as rfcf from orden a 
        left join catalogo.provedor b on b.prov=a.prv
        left join catalogo.compa c on c.cia=a.cia
        where a.id=$id
        group by prv";
        $query = $this->db->query($sql);
        
        return $query;
	} 
  /////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////     
   function busca_produc($clave)
	{
		 $id_user= $this->session->userdata('id');
        $sql = "SELECT codigo,concat(trim(marca_comercial),' ',trim(gramaje),' ',trim(contenido),' ',trim(presenta))as completo FROM catalogo.cat_nuevo_general where marca_comercial like '%$clave%' ";
        $query = $this->db->query($sql);
        $tabla="";
        foreach($query->result() as $row)
        {
            $tabla.="
            <option value =\"".$row->codigo."\">".$row->completo."</option>
            ";
        }
        return $tabla;
	} 
  /////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////     
}