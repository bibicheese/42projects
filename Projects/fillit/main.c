/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/23 19:01:19 by jmondino          #+#    #+#             */
/*   Updated: 2019/02/26 15:45:22 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

/*
** Main mise a jour pour prendre automatiquement la v_line la plus petite
*/

int		main(int ac, char **av)
{
	int		fd;
	int		v_line;
	char	*tetris;
	t_trm	*tet;

	if (ac != 2)
		ft_error(ac);
	if ((fd = open(av[1], O_RDONLY)) < 0)
		ft_error(2);
	ft_read(fd, &tetris);
	v_line = min_v_line(tetris);
	tet = ttrm_edit(tetris, v_line, 0);
	ft_memdel((void **)&tetris);
	backtrack(tet, NULL, 0);
	return (0);
}

void	ft_read(int fd, char **tetris)
{
	int		i;
	int		count;
	char	*tmp;
	char	*line;

	i = 0;
	count = 0;
	while (get_next_line(fd, &line))
	{
		count++;
		if (ft_check(line, count))
		{
			i++;
			*tetris = ft_stockalltetris(line);
		}
		tmp = line;
		ft_memdel((void **)&line);
	}
	if (*tetris == NULL)
		ft_error(2);
	ft_checklastline(tmp, i);
}
