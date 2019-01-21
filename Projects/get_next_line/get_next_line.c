/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/12/05 19:02:50 by jmondino          #+#    #+#             */
/*   Updated: 2019/01/21 15:59:43 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "get_next_line.h"

static int		ft_cutstr(char *buff, char **line, char **stock)
{
	char	*tmp;

	if (*stock == NULL)
		*stock = ft_strnew(1);
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
		*line = (*stock == NULL) ? ft_strsub(buff, 0, ft_strchr(buff, '\n') - buff) :
			ft_strjoin(*stock, ft_strsub(buff, 0, ft_strchr(buff, '\n') - buff));
		tmp = (*stock == NULL) ? ft_strjoin(*stock, (ft_strchr(buff, '\n') + 1)) :
			ft_strdup(ft_strchr(buff, '\n') + 1);
		free(*stock);
		*stock = tmp;
		return (0);
	}
	tmp = ft_strjoin(*stock, buff);
	free(*stock);
   	*stock = tmp;
	return (1);
}

int				get_next_line(const int fd, char **line)
{
	char			*tmp;
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
  		*line = (ft_iscinstr(stock, '\n')) ? ft_strsub(stock, 0, ft_strchr(stock, '\n') - stock) :
			ft_strdup(stock);
		tmp = (ft_iscinstr(stock, '\n')) ? ft_strdup(ft_strchr(stock, '\n') + 1) :
			NULL;
		free(stock);
		stock = tmp;
   		return (1);
	}
	return (0);
}
