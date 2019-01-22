/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/12/05 19:02:50 by jmondino          #+#    #+#             */
/*   Updated: 2019/01/22 14:45:24 by lucmarti         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "get_next_line.h"

static int		ft_cutstr(char *buff, char **line, char **stock)
{
	char	*tmp;
	char	*ooo;

	if (*stock == NULL)
		*stock = ft_strdup("");
   	if (ft_iscinstr(*stock, '\n'))
	{
		*line = ft_strsub(*stock, 0, ft_strchr(*stock, '\n') - *stock);
		tmp = (buff == NULL) ? ft_strdup(ft_strchr(*stock, '\n') + 1) :
		   ft_strjoin(ft_strchr(*stock, '\n') + 1, buff);
		free(*stock);
		*stock = tmp;
		return (0);
	}
	if (ft_iscinstr(buff, '\n'))
	{
		ooo = ft_strsub(buff, 0, ft_strchr(buff, '\n') - buff);
		*line = (*stock == NULL) ? ft_strsub(buff, 0, ft_strchr(buff, '\n') - buff) : ft_strjoin(*stock, ooo);
		ft_memdel((void **)&ooo);
		tmp = (*stock == NULL) ? ft_strjoin(*stock, (ft_strchr(buff, '\n') + 1)) :
			ft_strdup(ft_strchr(buff, '\n') + 1);
		ft_memdel((void **)stock);
		*stock = tmp;
		return (0);
	}	
	tmp = ft_strjoin(*stock, buff);
	//tmp = *stock = NULL ? ft_strdup(buff) : ft_strjoin(*stock, buff);
	ft_memdel((void **)stock);
   	*stock = tmp;
	return (1);
}

int				get_next_line(const int fd, char **line)
{
	char			*tmp;
	char			*ooo;
	static char		*stock;
	char			buff[BUFF_SIZE + 1];
	int				ret;

	if (fd < 0 || read(fd, buff, 0) == -1)
		return (-1);
	while ((ret = read(fd, buff, BUFF_SIZE)) > 0)
	{
		buff[ret] = '\0';
		if (ft_cutstr(buff, line, &stock) == 0)
   			return (1);
		ft_bzero(buff, BUFF_SIZE);
	}
	if (stock && *stock != '\0')
	{
		ooo = ft_strsub(stock, 0, ft_strchr(stock, '\n') - stock); 
  		*line = (ft_iscinstr(stock, '\n')) ? ft_strdup(ooo) : ft_strdup(stock);
		ft_memdel((void **)&ooo);
		tmp = (ft_iscinstr(stock, '\n')) ? ft_strdup(ft_strchr(stock, '\n') + 1) : NULL;
		ft_memdel((void **)&stock);
		stock = tmp;
   		return (1);
	}
	return (0);
}
